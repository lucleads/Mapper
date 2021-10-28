<?php

namespace lucleads\Mapper\Shared;

use lucleads\Mapper\Shared\Attributes\Map;
use lucleads\Mapper\Shared\Dtos\Dto;
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
     * @param $entity
     * @param $dtoClass
     * @param $mapperClass
     * @return Dto
     * @throws ReflectionException
     */
    public static function mapAutomatically($entity, $dtoClass, $mapperClass): Dto
    {
        $mapperReflectionClass = new ReflectionClass($mapperClass);
        $mapperAttributesInstances = self::filterAttributes($mapperReflectionClass->getAttributes());
        $entityAttributes = get_object_vars($entity);
        $dtoInstance = new $dtoClass();
        $dtoFields = get_class_vars($dtoClass);

        foreach ($dtoFields as $dtoFieldName => $dtoFieldValue) {
            if (empty($mapperAttributesInstances)) {
                self::searchFieldValueOutOfAttributes($dtoFieldName, $entityAttributes, $dtoInstance, $entity);
            } else {
                foreach ($mapperAttributesInstances as $mapperAttributeInstance) {
                    if ($dtoFieldName === $mapperAttributeInstance->getDtoField()) {
                        self::searchFieldSourceInMapperAttributes($mapperAttributeInstance, $entity, $dtoInstance, $dtoFieldName);
                    } else {
                        self::searchFieldValueOutOfAttributes($dtoFieldName, $entityAttributes, $dtoInstance, $entity);
                    }
                }
            }
        }

        return $dtoInstance;
    }

    /**
     * filterAttributes
     * @param array $classAttributes
     * @return array
     */
    private static function filterAttributes(array $classAttributes): array
    {
        $mapAttributesInstances = [];
        foreach ($classAttributes as $classAttribute) {
            $attributeInstance = $classAttribute->newInstance();
            if ($attributeInstance instanceof Map) {
                array_push($mapAttributesInstances, $attributeInstance);
            }
        }
        return $mapAttributesInstances;
    }

    /**
     * searchForEntityGetter
     * @param $entity
     * @param mixed $dtoFieldName
     * @param mixed $dtoInstance
     * @throws ReflectionException
     */
    private static function searchForEntityGetter($entity, mixed $dtoFieldName, mixed $dtoInstance): void
    {
        $entityReflection = new ReflectionClass($entity);
        $searchedMethod = 'get' . str_replace('_', '', ucwords($dtoFieldName, '_'));
        $existsGetter = $entityReflection->hasMethod($searchedMethod);
        if ($existsGetter) {
            $reflectionMethod = $entityReflection->getMethod($searchedMethod);
            $dtoInstance->set($dtoFieldName, $reflectionMethod->invoke($entity));
        }
    }

    /**
     * searchSourceInMapperAttributes
     * @param Map $attributeInstance
     * @param $entity
     * @param mixed $dtoInstance
     * @param mixed $dtoFieldName
     * @throws ReflectionException
     */
    private static function searchFieldSourceInMapperAttributes(Map $attributeInstance, $entity, mixed $dtoInstance, mixed $dtoFieldName): void
    {
        $sourceLayers = $attributeInstance->getLayers();
        $lastLayerValue = self::getValueLastLayer($entity, $sourceLayers);
        $dtoInstance->set($dtoFieldName, $lastLayerValue);
    }

    /**
     * searchAttributeInEntity
     * @param mixed $dtoInstance
     * @param mixed $dtoFieldName
     * @param $entityAttributes
     */
    private static function searchAttributeInEntity(mixed $dtoInstance, mixed $dtoFieldName, $entityAttributes): void
    {
        $dtoInstance->set($dtoFieldName, $entityAttributes);
    }

    /**
     * searchValueOutOfAttributes
     * @param int|string $dtoFieldName
     * @param mixed $entityAttributes
     * @param mixed $dtoInstance
     * @param $entity
     * @throws ReflectionException
     */
    private static function searchFieldValueOutOfAttributes(int|string $dtoFieldName, mixed $entityAttributes, mixed $dtoInstance, $entity): void
    {
        if (array_key_exists($dtoFieldName, $entityAttributes)) {
            self::searchAttributeInEntity($dtoInstance, $dtoFieldName, $entityAttributes[$dtoFieldName]);
        } else {
            self::searchForEntityGetter($entity, $dtoFieldName, $dtoInstance);
        }
    }

    /**
     * getValueLastLayer
     * @param $entity
     * @param array $sourceLayers
     * @return mixed
     * @throws ReflectionException
     */
    private static function getValueLastLayer($entity, array $sourceLayers): mixed
    {
        $nextAttribute = $entity;
        foreach ($sourceLayers as $layer) {
            $nextLayerReflection = new ReflectionClass($nextAttribute);
            $nextLayerReflectionGetAttributeMethod = $nextLayerReflection->getMethod('get' . str_replace('_', '', ucwords($layer, '_')));
            $nextAttribute = $nextLayerReflectionGetAttributeMethod->invoke($nextAttribute);
        }
        return $nextAttribute;
    }
}