<?php namespace Knoters\Repositories;

interface NoteRepository extends AbstractRepository
{
    /**
     * Get a collection of resources by the project id
     *
     * @param $projectId
     * @param array $relations
     * @param array $columns
     * @return mixed
     */
    public function getByProjectId($projectId,  $relations = [], $columns = ['*']);


    /**
     * Get a collection of resources by the project id and an set of searchvalues
     *
     * @param $projectId
     * @param $searchvalues
     * @param array $relations
     * @param array $columns
     * @return mixed
     */
    public function getByProjectIdAndSearch($projectId, $searchvalues, $relations = [], $columns = ['*']);

    /**
     * Find a resource by its uuid
     *
     * @param $uuid
     * @param $relations
     * @param $columns
     * @return mixed
     */
    public function findByUuid($uuid, $relations, $columns);

    /**
     * Edit a DB entry by key and index
     *
     * @param $assetKey
     * @param $params
     * @return mixed
     */
    public function editByKey($assetKey, $params);

    /**
     * Delete a DB entry by its uuid
     *
     * @param $uuid
     * @return mixed
     */
    public function deleteByUuid($uuid);
}