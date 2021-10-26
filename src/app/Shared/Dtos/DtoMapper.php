<?php

namespace App\Shared\Dtos;

use ReflectionException;
use ReflectionMethod;

/**
 * Class DtoMapper
 * @package Ngcs\Iaas\Network\Shared\Dtos
 */
abstract class DtoMapper
{
    /**
     * map
     * @param object $entity
     * @param string $dtoClass
     * @return Dto
     * @throws ReflectionException
     */
    public static function map(object $entity, string $dtoClass): Dto
    {
        $entityMap = get_object_vars($entity);
        $dtoInstance = new $dtoClass;
        $dtoAttributes = get_class_vars($dtoClass);

        foreach ($dtoAttributes as $field => $value) {
            $searchedMethod = 'get' . str_replace('_', '', ucwords($field, '_'));
            if (method_exists($entity, $searchedMethod)) {
                $reflectionMethod = new ReflectionMethod(get_class($entity), $searchedMethod);
                $dtoInstance->set($field, $reflectionMethod->invoke($entity));
            } elseif (array_key_exists($field, $entityMap)) {
                $dtoInstance->set($field, $entityMap[$field]);
            }

        }

        return $dtoInstance;
    }
}