<?php

namespace Scern\Lira;

use Scern\Lira\Config\Source;

class Lexicon
{
    public Lang $lang;
    protected array $lexicon = [];

    public function add(Source $source, ?Lang $lang = null): void
    {
        if (is_null($lang)) $lang = $this->default_lang;
        if (!array_key_exists($lang->code, $this->lexicon)) $this->lexicon[$lang->code] = $source->getArray();
        else $this->lexicon[$lang->code] += $source->getArray();
    }

    public function get(string $key, $default_value = null, ?string $lang = null)
    {
        if (is_null($lang)) $lang = $this->lang->code;
        $result = isset($this->lexicon[$lang][$key]) ? $this->lexicon[$lang][$key] : $default_value;
        return $result;
    }

    public function __construct(public readonly Lang $default_lang)
    {
        $this->lang = $this->default_lang;
    }
}