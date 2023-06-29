<?php

namespace Scern\Lira\Application;

use Exception;
use Scern\Lira\Application\Interfaces\Controller;

class Router
{
    public function __construct(private string $path_uri,private string|array $default_class_controller, private array $routes=[])
    {
        if(!$this->isValidController($default_class_controller)) {
            throw new Exception('Default controller !defined');
        }
    }

    public function handle(?string $action=null): string|array
    {
        $path = $action ?? $this->path_uri;
        foreach ($this->routes as $regexp_template=>$class_controller){
            if(preg_match($regexp_template,$path)) {
                if($this->isValidController($class_controller)) return $class_controller;
            }
        }
        return $this->default_class_controller;
    }

    private function isValidController(string|array $class_controller): bool
    {
        if(is_array($class_controller)) list($class_controller,$action) = $class_controller;

        if(!class_exists($class_controller)) {
            //EventDispatcher::event('needToLog',new \Exception("Class {$class_controller} !exists",500));
            return false;
        }
        if(!in_array(Controller::class,class_implements($class_controller,true))) {
            //EventDispatcher::event('needToLog',new \Exception("Controller {$class_controller} !executable",500));
            return false;
        }
        return true;
    }
}