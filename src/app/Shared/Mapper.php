<?php

namespace App\Shared;

use App\Shared\Attributes\MapAttr;
use App\Shared\Dtos\Dto;
use ReflectionClass;
use ReflectionException;

/**
 * Class Mapper
 * @package ${NAMESPACE}
 */
abstract class Mapper
{
    /**
     * automaticMap
     * @param $object
     * @param $dto
     * @param $mapperClass
     * @return Dto
     * @throws ReflectionException
     */
    public static function mapAutomatically($object, $dto, $mapperClass): Dto
    {
        $rc = new ReflectionClass($mapperClass);
        $methodAnnotations = $rc->getAttributes();
        $entityAttrs = $object->values();
        $dtoInstance = new $dto($object);
        $dtoAttrs = get_class_vars($dto);

        foreach ($dtoAttrs as $dtoAttrKey => $dtoAttrVal) {
            foreach ($methodAnnotations as $methodAnnot) {
                $methodAnn = $methodAnnot->newInstance();
                if ($methodAnn instanceof MapAttr) {
                    if ($dtoAttrKey == $methodAnn->getDtoField()) {
                        $sourceLayers = $methodAnn->getLayers();
                        $nextAttributte = $object;
                        foreach ($sourceLayers as $layer) {
                            $trc = new ReflectionClass($nextAttributte);
                            $trcMethod = $trc->getMethod('get' . $layer);
                            $nextAttributte = $trcMethod->invoke($nextAttributte);
                        }
                        $dtoInstance->set($dtoAttrKey, $nextAttributte);
                    } elseif (array_key_exists($dtoAttrKey, $entityAttrs)) {
                        $dtoInstance->set($dtoAttrKey, $entityAttrs[$dtoAttrKey]);
                    }
                }
            }
        }

        return $dtoInstance;
    }
}