<?php

namespace Scern\Lira\Module;

use Scern\Lira\{Core, Lang as CoreLang};
use Scern\Lira\Application\Result\{Result, ResultInternalRedirect, ResultHttpRedirect, ResultJson};
use Scern\Lira\Application\{Interfaces\Controller};

class Lang implements Controller
{
    public function handle(string $url): Result
    {
        if($url=='change') return $this->change();
        return $this->defineLang();
    }

    private function defineLang(): Result
    {
        $request_uri = Core::APP()->request->getRequestUri();
        $default_language = Core::CONFIG()->get('default_language');
        $lang = trim(substr($request_uri,0,3),'/');
        $redirect_url = substr($request_uri,3);
        if(empty($redirect_url)) $redirect_url = '/';
        if($lang==$default_language) return new ResultHttpRedirect($redirect_url,301);
        else {
            Core::LEXICON()->lang = new CoreLang($lang);
            return new ResultInternalRedirect($redirect_url);
        }
    }

    private function change(): Result
    {
        $request = Core::APP()->request;

        $new_lang = $request->get('lang');
        $url = $request->get('url');

        $url_array = parse_url($url);
        $path = $url_array['path'] ?? '/';
        $query = !empty($url_array['query']) ? '?'.$url_array['query'] : '';

        $site_languages = Core::CONFIG()->get('site_languages');
        $default_language = Core::CONFIG()->get('default_language');
        $path_array = array_filter(explode('/',$path));

        $lang = reset($path_array);

        if(!in_array($new_lang,$site_languages)) return new ResultJson(['success'=>false]);
        if($new_lang==$lang) return new ResultJson(['success'=>false]);
        if(in_array($lang,$site_languages)){
            if($new_lang==$default_language) array_shift($path_array);
            else {
                if($new_lang==$default_language) return new ResultJson(['success'=>false]);
                $path_array[array_key_first($path_array)] = $new_lang;
            }
        }else{
            if($new_lang==$default_language) return new ResultJson(['success'=>false]);
            array_unshift($path_array,$new_lang);
        }

        $path = implode('/',$path_array);
        return new ResultJson(['success'=>true,'redirect'=>'/'.$path.$query]);
    }

    public function __construct(private string $url_path)
    {
    }
}