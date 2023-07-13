<?php

namespace Scern\Lira\Application\AccessControl;

class Group
{
    private static array $permissions = [];

    public function __construct(public readonly string $name, public readonly Role $role)
    {
    }

    public function isMethodAllowed(string $method): bool
    {
        if (!empty(self::$permissions[$this->name])) foreach (self::$permissions[$this->name] as $key => $list_methods) {
            if (is_a($this->role, $key) && array_key_exists($method, $list_methods) && $list_methods[$method]) return true;
        }
        return false;
    }

    public static function allow(string $group_name, string $role_class, string $method): void
    {
        $caller_class = self::defineCallerClass(__FUNCTION__);
        if(!is_null($caller_class)) self::$permissions[$group_name][$role_class][$caller_class.'::'.$method] = true;
    }

    public static function disallow(string $group_name, string $role_class, string $method): void
    {
        $caller_class = self::defineCallerClass(__FUNCTION__);
        if(!is_null($caller_class)) self::$permissions[$group_name][$role_class][$caller_class.'::'.$method] = false;
    }

    private static function defineCallerClass(string $function_name): ?string
    {
        $debug = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        return array_reduce(
            $debug,
            fn($carry, $item)=>is_string($carry) ? $carry :
                (isset($carry['function']) && $carry['function'] == $function_name ? $item['class'] :
                    ($item['function']==$function_name ? $item : null)
                )
        );
    }
}