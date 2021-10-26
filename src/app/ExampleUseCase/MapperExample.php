<?php

namespace App\ExampleUseCase;

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
    public function mapRandomPerson()
    {
        $person = new Person(33, new Name("Roger Swagger Reynolds"), new Phones(["111111111", "222222222"]));
        $mapper = new PersonOutputDtoMapper($person);
        $dtoFields = $mapper->map()->getFields();
        foreach ($dtoFields as $fieldName => $fieldValue) {
            if (is_array($fieldValue)) {
                echo '<h1>' . $fieldName . ' : <br>';
                foreach ($fieldValue as $value) {
                    echo '-           ' . $value . '<br>';
                }
                echo '</h1>';
            } else {
                echo '<h1>' . $fieldName . ' : ' . $fieldValue . '</h1>';
            }
        }
    }
}
