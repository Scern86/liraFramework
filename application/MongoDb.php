<?php

namespace Scern\Lira\Application;

use Scern\Lira\Database;

class MongoDb extends Database
{
    private static array $databases=[];

    public ?\MongoDB\Database $db;

    public function isAllowToAdd(): bool
    {
        return parent::isAllowToAdd();
    }

    public function __construct(array $config)
    {
        try{
            extract($config);
            if(!array_key_exists($database,self::$databases)){
                $dsn = "mongodb://{$host}:{$port}";
                $client = new \MongoDB\Client($dsn);
                $this->db = $client->selectDatabase($database);
            }else{
                $this->db = null;
                // Log
            }
        }catch (\Throwable $e){
            var_dump($e);
        }
    }
}