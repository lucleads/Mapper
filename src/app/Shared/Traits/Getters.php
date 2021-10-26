<?php

namespace App\Shared\Traits;

/**
 * Trait Getters
 */
trait Getters
{
    /**
     * get
     * @param $campo
     * @return mixed
     */
    public function get($campo)
    {
        return $this->{$campo};
    }
}