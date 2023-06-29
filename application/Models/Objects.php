<?php

namespace Scern\Lira\Application\Models;

class Objects extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = $this->db->selectCollection('objects');
    }
}