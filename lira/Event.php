<?php

namespace Scern\Lira;

readonly class Event
{
    public ?string $source;

    public function __construct(public string $event_name, public string $message = '', public int|string $code = 0, public array $params = [])
    {
        $function = 'triggerEvent';
        $debug = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 0);
        $this->source = array_reduce(
            $debug,
            fn($carry, $item)=>is_string($carry) ? $carry :
                (isset($carry['function']) && $carry['function'] == $function ? $item['class'] :
                    ($item['function']==$function ? $item : null)
                )
        );
    }
}