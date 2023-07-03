<?php

namespace Scern\Lira\Module;

use Scern\Lira\Application\View;
use Scern\Lira\Application\Result\{Result,ResultError};
use Scern\Lira\Application\Interfaces\Controller;
use Scern\Lira\Core;
use Symfony\Component\HttpFoundation\Response;

class DefaultController implements Controller
{
    public function __construct(private string $url_path)
    {
    }

    public function handle(string $url): Result
    {
        $view = Core::APP()->view;
        $view->header = 'Default';
        $view->setTemplate(ROOT_DIR.DS.'module'.DS.'Front'.DS.'templates'.DS.'error.inc');
        return new ResultError('Not found',404,Response::HTTP_NOT_FOUND);
    }
}