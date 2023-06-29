<?php

namespace Scern\Lira\Application;

use Scern\Lira\Database;

class Postgresql extends Database
{
    private static array $databases=[];

    public  ?\PDO $db;

    public function isAllowToAdd(): bool
    {
        return parent::isAllowToAdd();
    }

    public function __construct(array $config)
    {
        extract($config);
        if(!array_key_exists($dbname,self::$databases)){
            try{
                $dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
                $this->db = new \PDO($dsn, $username, $password);
            }catch (\PDOException $e){
                //var_dump($e);
                //EventDispatcher::event('needToLog',new \Exception("Database {$dbname} connect error",500));
                $this->db = null;
            }

        }else{
            //EventDispatcher::event('needToLog',new \Exception("Database {$dbname} connect error",500));
        }
    }
}