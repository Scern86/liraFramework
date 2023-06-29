<?php

namespace Scern\Lira;

class CacheManager
{
    private array $cache_instances = [];

    public function add($cache_instance, string $prefix = 'default'): void
    {
        $cache_name = $cache_instance::class . ':' . $prefix;
        if (!array_key_exists($cache_name, $this->cache_instances)) $this->cache_instances[$cache_name] = $cache_instance;
    }

    public function get(string $name, string $prefix = 'default'): ?object
    {
        $cache_name = $name . ':' . $prefix;
        return array_key_exists($cache_name, $this->cache_instances) ? $this->cache_instances[$cache_name] : null;
    }
}