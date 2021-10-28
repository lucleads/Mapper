<?php

namespace lucleads\Mapper\Shared\Traits;

/**
 * Trait Setters
 */
trait Setters
{
    /**
     * set
     * @param $fieldName
     * @param $value
     */
    public function set($fieldName, $value)
    {
        $this->$fieldName = $value;
    }
}