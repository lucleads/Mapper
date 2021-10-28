<?php

namespace lucleads\Mapper\ExampleUseCase;

use lucleads\Mapper\ExampleUseCase\Entities\Person;
use lucleads\Mapper\ExampleUseCase\Entities\ValueObjects\Name;
use lucleads\Mapper\ExampleUseCase\Entities\ValueObjects\Phones;
use lucleads\Mapper\ExampleUseCase\Mappers\PersonOutputDtoMapper;

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
