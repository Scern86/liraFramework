<?php

namespace Scern\Lira\Application;

use \Scern\Lira\Application\Traits\{Getter, Setter};

class Container
{
    use Getter, Setter;

    private array $values = [];

    public function __construct(bool $append_donly = false)
    {
        $this->append_only_setter = $append_donly;
    }
}