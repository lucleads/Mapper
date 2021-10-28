<?php

namespace lucleads\Mapper\ExampleUseCase\Dtos;

use lucleads\Mapper\Shared\Dtos\Dto;

/**
 * Class PersonOutputDto
 * @package ${NAMESPACE}
 */
final class PersonOutputDto extends Dto
{
    public string $fullName;
    public string $firstName;
    public string $firstSurname;
    public string $secondSurname;
    public int $age;
    public array $telephoneNumbers;
}