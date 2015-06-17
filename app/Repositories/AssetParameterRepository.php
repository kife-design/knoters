<?php namespace Knoters\Repositories;

interface AssetParameterRepository extends AbstractRepository
{
    public function storeBulk($id, $data);
}