<?php

namespace Scern\Lira\Application\Models;

use MongoDB\BSON\ObjectId;
use MongoDB\Database;
use MongoDB\Model\BSONDocument;

class User extends Objects
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getById(string $id): ?BSONDocument
    {
        try{
            return $this->table->findOne(['_id'=>new ObjectId($id)]);
        } catch (\Throwable $e){
            //log
        }
        return null;
    }

    /**
     * @param array $user
     * @return string $user_id|NULL
     */
    public function create(array $user): ?string
    {
        try{
            $result = $this->table->insertOne($user);
            if($result->getInsertedCount()==1) return $result->getInsertedId();
        } catch (\Throwable $e){
            // log
        }
        return null;
    }

    public function updateById(string $id,array $user): bool
    {
        try{
            $result = $this->table->updateOne(['_id'=>new ObjectId($id)],['$set'=>$user]);
            return $result->getModifiedCount()==1;
        }catch (\Throwable $e){
            //log
        }
        return false;
    }

    public function deleteById(string $id): bool
    {
        try{
            $result = $this->table->deleteOne(['_id'=>new ObjectId($id)]);
            return $result->getDeletedCount()==1;
        }catch (\Throwable $e){
            //log
        }
        return false;
    }

    public function getByLogin(string $login): ?BSONDocument
    {
        try{
            return $this->table->findOne(['login'=>$login,'type'=>'user']);
        } catch (\Throwable $e){
            //log
        }
        return null;
    }

    public function getList(int $limit=10,int $offset=0): array
    {
        try{
            $result = $this->table->find(['type'=>'user'])?->toArray();
            return (array) $result;
        }catch (\Throwable $e){
            // Log
            var_dump($e);
        }
        return [];
    }
}