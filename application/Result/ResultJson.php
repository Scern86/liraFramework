<?php

namespace Scern\Lira\Application\Result;

use Symfony\Component\HttpFoundation\Response;

readonly class ResultJson extends Result
{
    public function __construct(public mixed $content=null,public int $http_status_code=Response::HTTP_OK,public array $headers=[])
    {
    }
}