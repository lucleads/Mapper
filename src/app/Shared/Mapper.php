<?php

namespace App\Shared;

use App\Shared\Dtos\Dto;

/**
 * Class Mapper
 * @package ${NAMESPACE}
 */
abstract class Mapper
{
    /**
     * map
     * @param $object
     * @param $dto
     * @return Dto
     */
    protected static function map($object, $dto): Dto
    {
        $values = $object->values();
        $dtoInstance = new $dto;
        $attrs = get_class_vars($dto);

        foreach ($attrs as $k => $v) {
            if (array_key_exists($k, $values)) {
                $dtoInstance->set($k, $values[$k]);
            }
        }

        return $dtoInstance;
    }
}