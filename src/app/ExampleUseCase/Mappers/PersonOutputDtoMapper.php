<?php

namespace App\ExampleUseCase\Mappers;

use App\ExampleUseCase\Dtos\PersonOutputDto;
use App\ExampleUseCase\Entities\Person;
use App\Shared\Attributes\MapAttr;
use App\Shared\Dtos\Dto;
use App\Shared\Mapper;
use ReflectionException;

/**
 * Class PersonOutputDtoMapper
 * @package ${NAMESPACE}
 * @internal
 */
#[MapAttr('Name.name', 'firstName')]
#[MapAttr('Phones.phoneNumbers', 'telephoneNumbers')]
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
    public function map(): Dto
    {
        return $this::mapAutomatically($this->person, PersonOutputDto::class, self::class);
    }
}