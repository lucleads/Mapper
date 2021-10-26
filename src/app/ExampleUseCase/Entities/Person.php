<?php

namespace App\ExampleUseCase\Entities;

use App\ExampleUseCase\Entities\ValueObjects\Name;
use App\ExampleUseCase\Entities\ValueObjects\Phones;
use App\Shared\Traits\Getters;

/**
 * Class Person
 * @package ${NAMESPACE}
 * @internal
 */
final class Person
{
    use Getters;

    public function __construct(public int $age, public Name $name, public Phones $phoneNumbers)
    {
    }

    /**
     * create
     * @param int $age
     * @param Name $name
     * @param array $phoneNumbers
     * @return Person
     */
    public function create(int $age, Name $name, Phones $phoneNumbers): self
    {
        return new self($age, $name, $phoneNumbers);
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getPhoneNumbers(): array
    {
        return ["941652365", "658741342"];
    }

    public function getPhones(): Phones
    {
        return $this->phoneNumbers;
    }

    public function values(): array
    {
        $vars = get_class_vars(__CLASS__);

        $str = [];

        foreach ($vars as $key => $value) {
            $str[$key] = $this->{$key};
        }

        return $str;
    }
}