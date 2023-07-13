<?php

namespace Scern\Lira;

readonly class Lang
{
    public string $url_part;

    public function __construct(public string $code='ru')
    {
        $this->url_part = $code!==Core::CONFIG()->get('default_language') ? '/'.$this->code : '';
    }
}