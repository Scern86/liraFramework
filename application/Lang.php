<?php

namespace Scern\Lira\Application;

use Scern\Lira\Core;

readonly class Lang
{
    public string $url_part;

    public function __construct(public string $code='ru')
    {
        $this->url_part = $code!==Core::CONFIG()->get('default_language') ? '/'.$this->code : '';
    }
}