<?php

namespace App\ExampleUseCase\Entities\ValueObjects;

/**
 * Class Name
 * @package ${NAMESPACE}
 * @internal
 */
final class Name
{
    public function __construct(private string $fullName)
    {
    }

    public function value(): string
    {
        return $this->fullName;
    }

    public function getName(): string
    {
        return explode(" ", $this->fullName)[0];
    }

    public function getFirstSurname(): string
    {
        return explode(" ", $this->fullName)[1];
    }

    public function getSecondSurname(): string
    {
        return explode(" ", $this->fullName)[2];
    }
}