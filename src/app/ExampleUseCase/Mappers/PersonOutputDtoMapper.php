<?php

namespace App\ExampleUseCase\Mappers;

use App\ExampleUseCase\Dtos\PersonOutputDto;
use App\ExampleUseCase\Entities\Person;
use App\Shared\Attributes\MapAttr;
use App\Shared\Dtos\Dto;
use App\Shared\Dtos\DtoMapper;
use App\Shared\Mapper;
use ReflectionClass;
use ReflectionException;

/**
 * Class PersonOutputDtoMapper
 * @package ${NAMESPACE}
 * @internal
 */
final class PersonOutputDtoMapper extends Mapper
{
    private Dto $dto;

    public function __construct(private Person $person)
    {
        $this->dto = new PersonOutputDto();
    }

    /**
     * map
     * @return Dto
     * @throws ReflectionException
     */
    public function map2(): Dto
    {
        return DtoMapper::map($this->person, PersonOutputDto::class);
    }

    /**
     * @throws ReflectionException
     */
    #[MapAttr('Name.name', 'firstName')]
    #[MapAttr('Phones.phoneNumbers', 'telephoneNumbers')]
    public static function map($object, $dto): Dto
    {
        $rc = new ReflectionClass(PersonOutputDtoMapper::class);
        $m = $rc->getMethod('map');
        $methodAnnotations = $m->getAttributes();
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