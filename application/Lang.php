<?php

namespace Scern\Lira\Application;

use Scern\Lira\Core;

class Lang
{
    public readonly string $url_part;

    public function __construct(public readonly string $code='ru')
    {
        $this->url_part = $code!==Core::CONFIG()->get('default_language') ? '/'.$this->code : '';
    }
}