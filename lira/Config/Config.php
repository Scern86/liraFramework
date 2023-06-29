<?php

namespace Scern\Lira\Config;

class Config
{
    private static array $values=[];

    public function add(Source $source, string $prefix='default'): void
    {
        $array = $source->getArray();
        if($prefix=='default') self::$values += $array;
        else{
            if(!array_key_exists($prefix,self::$values)) self::$values[$prefix] = $array;
        }
    }

    public function get(string $key)
    {
        return array_key_exists($key,self::$values) ? self::$values[$key] : null;
    }
}