<?php

namespace Scern\Lira\Application\Models;

use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;

class Definitions extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = $this->db->selectCollection('definitions');
    }

    public function create(array $data): ?string
    {
        try{
            $result = $this->table->insertOne($data);
            if($result->getInsertedCount()==1) return $result->getInsertedId();
        } catch (\Throwable $e){
            // log
        }
        return null;
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

    public function updateById(string $id,array $data): bool
    {
        try{
            $result = $this->table->updateOne(['_id'=>new ObjectId($id)],['$set'=>$data]);
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

    public function getAll(): array
    {
        $result = [];
        try{
            $result = $this->table->find()?->toArray();
        }catch (\Throwable $e){
            // Log
            //var_dump($e);
        }
        return (array) $result;
    }
}