<?php

namespace Scern\Lira\Application;

class View extends Container
{
    public mixed $content=null;
    private bool $only_content = false;

    public function __construct(private array $values=[], private ?string $template_file=null)
    {
        parent::__construct();
    }

    public function onlyContent(): void
    {
        $this->only_content = true;
    }

    public function setTemplate(string $template_file): void
    {
        if(file_exists($template_file)) $this->template_file = $template_file;
        else {
            // log Template !exists
        }
    }

    public function execute(?string $template_file = null): string
    {
        $result = '';
        if ($this->only_content) $result = $this->content;
        else{
            $template = null;
            if (!is_null($template_file) && file_exists($template_file)) $template = $template_file;
            elseif (!is_null($this->template_file) && file_exists($this->template_file)) $template = $this->template_file;
            if(!is_null($template)){
                ob_start();
                include $template;
                $result = ob_get_clean();
            }
            else{
                $result = $this->content;
                //EventDispatcher::event('needToLog',new \Exception("View template not defined",400));
            }
        }
        if(!is_string($result)) {
            //log Invalid result type
            //EventDispatcher::event('needToLog',new \Exception("Invalid result type",400));
            $result = '';
        }
        return $result;
    }
}

