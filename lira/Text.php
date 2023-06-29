<?php

namespace Scern\Lira;

class Text
{
    public static function replaceShortCodes(string $string,array $short_codes)
    {
        return preg_replace_callback('#\[\[(?<short>\w+)\]\]#',fn($matches) => !empty($short_codes[$matches['short']])?$short_codes[$matches['short']]:'',$string);
    }

    /**
     * @param string $pattern {D}=digit,{L}=letter,{S}=special character
     * @param array UTF8 $character_set [D=>0-9,L=>a-zA-Z,S=>!@#$%^]
     * @return string
     */
    public static function createRandomStringByPattern(string $pattern='+{L}({D}{D}{D})-{D}{D}{D}-{D}{D}-{D}{D}',array $character_set=['D'=>'0123456789','L'=>'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ','S'=>'!@#$%&*']): string
    {
        $result = $pattern;
        if(!empty($character_set)) foreach ($character_set as $key=>$symbols){
            $symbols_length = mb_strlen($symbols);
            if($symbols_length>1) $result = preg_replace_callback("#{{$key}}#",fn($matches)=>mb_substr($symbols,mt_rand(0,$symbols_length-1),1),$result);
        }
        return $result;
    }

    /**
     * @param int $length
     * @param string UTF8 $character_set '0-9a-zA-Z'
     * @return string
     */
    public static function createRandomStringByLength(int $length=5,string $character_set='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string
    {
        $shuffle_array = mb_str_split($character_set,1);
        shuffle($shuffle_array);
        return mb_substr(implode('',$shuffle_array), 0, $length);
    }
}