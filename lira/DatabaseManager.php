<?php

namespace Scern\Lira;

class DatabaseManager
{
    private static array $databases = [];

    public function add(Database $database, string $prefix = 'default'): void
    {
        if ($database->isAllowToAdd()) {
            $database_name = $database::class . ':' . $prefix;
            if (!array_key_exists($database_name, self::$databases)) self::$databases[$database_name] = $database;
        }
    }

    public function get(string $database, string $prefix = 'default'): null|\MongoDB\Database|\PDO
    {
        $database_name = $database . ':' . $prefix;
        return array_key_exists($database_name, self::$databases) ? self::$databases[$database_name]->db : null;
    }
}