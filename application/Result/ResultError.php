<?php

namespace Scern\Lira\Application\Result;

use Symfony\Component\HttpFoundation\Response;

class ResultError extends Result
{
    public function __construct(public readonly string $message,public readonly int $error_code=0,public readonly int $http_status_code=Response::HTTP_OK,public readonly array $headers=[])
    {
    }
}