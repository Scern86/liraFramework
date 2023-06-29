<?php

namespace Scern\Lira\Application\Result;

use Symfony\Component\HttpFoundation\Response;

class ResultJson extends Result
{
    public function __construct(public readonly mixed $content=null,public readonly int $http_status_code=Response::HTTP_OK,public readonly array $headers=[])
    {
    }
}