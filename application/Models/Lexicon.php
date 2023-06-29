<?php

namespace Scern\Lira\Application\Models;

use MongoDB\BSON\ObjectId;
use Scern\Lira\Core;
use MongoDB\Model\BSONDocument;

class Lexicon extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = $this->db->selectCollection('lexicon');
    }

    public function getById(string $id): ?object
    {
        try{
            return $this->table->findOne(['_id'=>new ObjectId($id)]);
        }catch (\Throwable $e){
            //log
            //var_dump($e);
        }
        return null;
    }
    public function getByKey(string $key,string $lang_code,string $module='ALL',string $target='PHP'): ?string
    {
        try{
            $search = ['key'=>$key];
            if($target!=='ALL') $search['target'] = ['$in'=>['ALL',$target]];
            if($module!=='ALL') $search['module'] = ['$in'=>['ALL',$module]];
            $result = $this->table->findOne($search);
            return isset($result[$lang_code]) ? $result[$lang_code] : null;
        }catch (\Throwable $e){
            //log
            //var_dump($e);
        }
        return null;
    }
    public function getLexems(string $lang_code,string $module='ALL',string $target='ALL'): array
    {
        try{
            $result = [];
            $search = [];
            if($target!=='ALL') $search['target'] = ['$in'=>['ALL',$target]];
            if($module!=='ALL') $search['module'] = ['$in'=>['ALL',$module]];
            $array = $this->table->find($search)->toArray();
            if(!empty($array)) foreach ($array as $item){
                if(!isset($item[$lang_code])) continue;
                $result[$item['key']] = $item[$lang_code];
            }
            return $result;
        }catch (\Throwable $e){
            //log
            //var_dump($e);
        }
        return [];
    }

    public function getAll(int $limit=100,int $offset=0): array
    {
        try{
            return $this->table->find()->toArray();
        }catch (\Throwable $e){
            //log
            //var_dump($e);
        }
        return [];
    }


    public function createLexem(array $data): ?string
    {
        try{
            $result = $this->table->insertOne($data);
            if($result->getInsertedCount()==1) return $result->getInsertedId();
            //if($result->getInsertedCount()==1) return true;
        } catch (\Throwable $e){
            // log
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
}