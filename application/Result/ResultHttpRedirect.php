<?php

namespace Scern\Lira\Application\Result;

readonly class ResultHttpRedirect extends Result
{
    public function __construct(public string $url, public int $http_status_code = 302)
    {
    }
}