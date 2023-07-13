<?php

namespace Scern\Lira\Application\Result;

use Symfony\Component\HttpFoundation\Response;

readonly class ResultSuccess extends Result
{
    public function __construct(public int $http_status_code=Response::HTTP_OK,public array $headers=[])
    {
    }
}