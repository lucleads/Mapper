<?php

namespace lucleads\Mapper\Shared\Attributes;

use Attribute;

/**
 * Class MapAttr
 * @package App\Shared\Attributes
 */
#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_CLASS)]
class Map
{
    private array $layers;
    private string $dto;

    public function __construct(string $source, string $dtoField)
    {
        $this->layers = explode('.', $source);
        $this->dto = $dtoField;
    }

    public function getLayers(): array
    {
        return $this->layers;
    }

    public function getDtoField(): string
    {
        return $this->dto;
    }


}