<?php namespace Knoters\Repositories;

/**
 * Interface AssetRepository
 * @package Knoters\Repositories
 */
interface AssetRepository extends AbstractRepository
{
    /**
     * Find a colection item by its key
     * @param $key
     * @return mixed
     */
    public function findByKey($key);


    /**
     * Gets a collection of assets by a given upload id
     *
     * @param $uploadId
     * @param $with
     * @return mixed
     */
    public function getByUploadId($uploadId, $with);
}