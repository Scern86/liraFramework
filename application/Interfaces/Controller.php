<?php

namespace Scern\Lira\Application\Interfaces;

use Scern\Lira\Application\Result\Result;

interface Controller
{
    public function handle(string $url): Result;
}