<?php

namespace Scern\Lira\Application\Result;

class ResultInternalRedirect extends Result
{
    public function __construct(public readonly string $url)
    {
    }
}