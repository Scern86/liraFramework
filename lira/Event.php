<?php

namespace Scern\Lira;

class Event
{
    public readonly ?string $source;

    public function __construct(public readonly string $event_name, public readonly string $message = '', public readonly int|string $code = 0, public readonly array $params = [])
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