<?php

namespace Scern\Lira\Application\Traits;

trait Setter
{
    private readonly bool $append_only_setter;

    public function __set(string $key, $value)
    {
        if (!$this->append_only_setter || !array_key_exists($key, $this->values)) $this->values[$key] = $value;
    }

    public function __unset(string $key)
    {
        if (array_key_exists($key, $this->values) && !$this->append_only_setter) unset($this->values[$key]);
    }
}