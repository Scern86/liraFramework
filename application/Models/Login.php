<?php

namespace Scern\Lira\Application\Models;

use Scern\Lira\Core;
use MongoDB\Model\BSONDocument;
use Scern\Lira\Application\Models\Model;

class Login extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = $this->db->selectCollection('logins');
    }

    public function getUserSession(string $module): object|false
    {
        try{
            $search = [
                'ssid'=>Core::SESSION()->getSessionId(),
                'ip_address'=>Core::APP()->request->getClientIp(),
                'created'=>['$gte'=>date('Y-m-d')],
                'module'=>$module
            ];
            return $this->table->findOne($search);
        }catch (\Throwable $e){
            //log
            //var_dump($e);
        }
        return false;
    }

    public function save(string $user_id,string $module): void
    {
        $new = [
            'ssid'=>Core::SESSION()->getSessionId(),
            'created'=>date('Y-m-d H:i:s'),
            'user_id'=>$user_id,
            'ip_address'=>Core::APP()->request->getClientIp(),
            'module'=>$module
        ];
        try{
            $this->table->insertOne($new);
        }catch (\Throwable $e){
            //log
        }
    }
}