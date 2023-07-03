<?php

namespace Scern\Lira\Module\Front;

use Scern\Lira\Application\Result\{Result, ResultSuccess, ResultError};
use Scern\Lira\Application\Interfaces\Controller;
use Scern\Lira\Application\LexiconMongodbArray;
use Scern\Lira\Config\PhpArray;
use Scern\Lira\Core;

class Front implements Controller
{
    public const VERSION = '1.0.0';
    public function handle(string $url): Result
    {
        $view = Core::APP()->view;
        $view->setTemplate(ROOT_DIR . DS . 'module' . DS . 'Front' . DS . 'templates' . DS . 'default.inc');
        $view->meta_title = 'Lira';
        return new ResultSuccess();
    }

    public function __construct(private string $url_path)
    {
        Core::LEXICON()->add(new PhpArray(ROOT_DIR . DS . 'module' . DS . 'Front' . DS . 'Lexicon' . DS . Core::LEXICON()->lang->code . '.php'), Core::LEXICON()->lang);
        Core::LEXICON()->add(new LexiconMongodbArray(Core::LEXICON()->lang->code,'Front','PHP'), Core::LEXICON()->lang);
    }
}