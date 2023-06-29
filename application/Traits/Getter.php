<?php

namespace Scern\Lira\Application\Traits;

trait Getter
{
    public function __get(string $key)
    {
        return array_key_exists($key, $this->values) ? $this->values[$key] : null;
    }

    public function get(string $key, $default_value = null)
    {
        return array_key_exists($key, $this->values) ? $this->values[$key] : $default_value;
    }

    public function __isset(string $key)
    {
        return isset($this->values[$key]);
    }
}