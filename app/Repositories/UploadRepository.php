<?php namespace Knoters\Repositories;

interface UploadRepository extends AbstractRepository
{
    public function findByKeyWithRelations($key, $relations);

    public function findByKey($key);

    public function findByUploadEmailKey($key);
}