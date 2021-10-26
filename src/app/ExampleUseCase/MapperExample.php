<?php

namespace App\ExampleUseCase;

use App\ExampleUseCase\Dtos\PersonOutputDto;
use App\ExampleUseCase\Entities\Person;
use App\ExampleUseCase\Entities\ValueObjects\Name;
use App\ExampleUseCase\Entities\ValueObjects\Phones;
use App\ExampleUseCase\Mappers\PersonOutputDtoMapper;
use ReflectionException;

/**
 * Class MapperExample
 * @package App
 * @internal
 */
class MapperExample
{
    /**
     * @throws ReflectionException
     */
    public function map()
    {
        $person = new Person(33, new Name("Roger Swagger Reynolds"), new Phones(["111111111", "222222222"]));
        $mapper = new PersonOutputDtoMapper($person);
        $dtoFields = $mapper::map($person, PersonOutputDto::class)->getFields();
        foreach ($dtoFields as $fieldName => $fieldValue) {
            if (is_array($fieldValue)) {
                echo '<h1>' . $fieldName . ' : </h1>';
                foreach ($fieldValue as $value) {
                    echo '<br>' . $value . '<br>';
                }
            } else {
                echo '<br>' . $fieldName . ' : ' . $fieldValue . '<br>';
            }
        }
    }
}
