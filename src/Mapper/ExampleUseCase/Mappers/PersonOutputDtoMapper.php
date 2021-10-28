<?php

namespace lucleads\Mapper\ExampleUseCase\Mappers;

use lucleads\Mapper\ExampleUseCase\Dtos\PersonOutputDto;
use lucleads\Mapper\ExampleUseCase\Entities\Person;
use lucleads\Mapper\Shared\Attributes\Map;
use lucleads\Mapper\Shared\Dtos\Dto;
use lucleads\Mapper\Shared\Mapper;
use ReflectionException;

/**
 * Class PersonOutputDtoMapper
 * @package ${NAMESPACE}
 * @internal
 */
#[Map('Name.name', 'firstName')]
#[Map('Phones.phoneNumbers', 'telephoneNumbers')]
final class PersonOutputDtoMapper extends Mapper
{
    public function __construct(private Person $person)
    {
    }

    /**
     * map
     * @return Dto
     * @throws ReflectionException
     */
    public function map(): Dto
    {
        return $this::mapAutomatically($this->person, PersonOutputDto::class, self::class);
    }
}