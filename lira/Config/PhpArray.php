<?php

namespace Scern\Lira\Config;

use Throwable;

class PhpArray implements Source
{
    public function __construct(private ?string $config_file)
    {
        if(!file_exists($this->config_file)){
            // Log
            //EventDispatcher::event('needToLog',new \Exception("Config file {$this->config_file} not exist",400));
            $this->config_file = null;
        }
    }

    public function getArray(): array
    {
        $result = [];
        if(!is_null($this->config_file)){
            try{
                $result = include_once $this->config_file;
            }catch (Throwable $e){
                // Log
            }
        }
        return $result;
    }
}