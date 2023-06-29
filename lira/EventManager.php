<?php

namespace Scern\Lira;

class EventManager
{
    private array $event_listeners = [];

    public function trigger(string $event_name, string $message='', int|string $code = 0, array $params = []): void
    {
        $event = new Event($event_name, $message, $code, $params);
        if (array_key_exists($event_name, $this->event_listeners)) foreach ($this->event_listeners[$event_name] as $listener) {
            call_user_func($listener, $event);
        }
    }

    public function listen(string $event_name, callable $callback): void
    {
        $this->event_listeners[$event_name][] = $callback;
    }
}