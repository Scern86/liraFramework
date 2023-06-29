<?php

namespace Scern\Lira\Application;

use Scern\Lira\Application\Models\Lexicon;
use Scern\Lira\Config\Source;
use Throwable;

class LexiconMongodbArray implements Source
{
    public function __construct(private string $lang_code,private string $module='ALL',private string $target='ALL')
    {
    }

    public function getArray(): array
    {
        $result = [];
        $model = new Lexicon();
        try{
            $result = $model->getLexems($this->lang_code,$this->module,$this->target);
        } catch (Throwable $e){
            // Log
        }
        return $result;
    }
}