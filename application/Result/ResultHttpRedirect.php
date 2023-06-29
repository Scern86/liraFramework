<?php

namespace Scern\Lira\Application\Result;

class ResultHttpRedirect extends Result
{
    public function __construct(public readonly string $url, public readonly int $http_status_code = 302)
    {
    }
}