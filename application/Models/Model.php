<?php

namespace Scern\Lira\Application\Models;

use MongoDB\Database;
use Scern\Lira\Application\MongoDb;
use Scern\Lira\Core;

class Model
{
    protected Database $db;
    protected $table;

    public function __construct()
    {
        $this->db = Core::DATABASE()->get(MongoDb::class);
    }
}