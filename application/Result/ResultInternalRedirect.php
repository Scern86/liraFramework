<?php

namespace Scern\Lira\Application\Result;

readonly class ResultInternalRedirect extends Result
{
    public function __construct(public string $url)
    {
    }
}