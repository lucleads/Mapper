<?php

namespace App\Shared\Dtos;

use App\Shared\Traits\Getters;
use App\Shared\Traits\Setters;

/**
 * Class Dto
 * @package Ngcs\Iaas\Network\Shared\Dtos
 */
abstract class Dto
{
    use Getters;
    use Setters;

    public function getFields(): array
    {
        return json_decode(json_encode($this), true);
    }
}