<?php namespace Knoters\Repositories;

interface NoteRepository extends AbstractRepository
{
    /**
     * Get a collection Item by id
     *
     * @param $uploadId
     * @return mixed
     */
    public function getByUploadId($uploadId);

    /**
     * Get a collection item by key and index
     *
     * @param $key
     * @return mixed
     */
    public function findByKey($key, $columns = null);

    /**
     * Edit a DB entry by key and index
     *
     * @param $assetKey
     * @param $index
     * @param $params
     * @return mixed
     */
    public function editByKey($assetKey, $params);

    /**
     * Delete a DB entry by its id and the uploadkey
     *
     * @param $noteId
     * @param $uploadKey
     * @return mixed
     */
    public function deleteByIdAndUploadKey($noteId, $uploadKey);
}