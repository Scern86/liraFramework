<?php

namespace Scern\Lira\Application\Result;

use Symfony\Component\HttpFoundation\Response;

readonly class ResultError extends Result
{
    public function __construct(public string $message,public int $error_code=0,public int $http_status_code=Response::HTTP_OK,public array $headers=[])
    {
    }
}