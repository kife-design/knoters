<?php namespace Knoters\Repositories;

/**
 * Interface AssetRepository
 * @package Knoters\Repositories
 */
interface AssetRepository extends AbstractRepository
{


    /**
     * Gets a collection of assets by a given project id
     *
     * @param $projectId
     * @param $with
     * @return mixed
     */
    public function getByProjectId($projectId, $with);
}