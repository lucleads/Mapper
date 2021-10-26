<?php

namespace App\ExampleUseCase\Entities\ValueObjects;

/**
 * Class Phone
 * @package ${NAMESPACE}
 * @internal
 */
final class Phones
{
    public function __construct(private array $phoneNumbers)
    {
    }

    public function addPhoneNumber(int $phoneNumber): void
    {
        array_push($this->phoneNumbers, $phoneNumber);
    }

    public function getPhoneNumbers(): array
    {
        return $this->phoneNumbers;
    }
}