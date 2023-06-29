<?php

namespace Scern\Lira\Application;

use \Scern\Lira\Application\Traits\{Getter, Setter};

class Container
{
    use Getter, Setter;

    private array $values = [];

    public function __construct(bool $readonly = false)
    {
        $this->readonly_setter = $readonly;
    }
}