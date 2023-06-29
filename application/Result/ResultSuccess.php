<?php

namespace Scern\Lira\Application\Result;

use Symfony\Component\HttpFoundation\Response;

class ResultSuccess extends Result
{
    public function __construct(public readonly int $http_status_code=Response::HTTP_OK,public readonly array $headers=[])
    {
    }
}