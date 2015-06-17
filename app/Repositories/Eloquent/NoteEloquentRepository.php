<?php namespace Knoters\Repositories\Eloquent;

use Knoters\Models\Note;
use Knoters\Repositories\NoteRepository;

class NoteEloquentRepository extends AbstractEloquentRepository implements NoteRepository
{
    protected $model;

    function __construct(Note $model)
    {
        $this->model = $model;
    }

    /**
     * Get a collection Item by id
     *
     * @param $uploadId
     * @return mixed
     */
    public function getByUploadId($uploadId)
    {
        return $this->model->where('upload_id', '=', $uploadId)->get();
    }

    /**
     * Get a collection item by key and index
     *
     * @param string $key
     * @param array $columns
     * @return Note
     */
    public function findByKey($key, $columns = null)
    {
        $note = $this->model->where('key', '=', $key);

        if (!is_null($columns)) {
            return $note->lists($columns);
        }

        return $note->first();
    }

    /**
     * Edit a DB entry by key and index
     *
     * @param $assetKey
     * @param $index
     * @param $params
     * @return mixed
     * @throws Exception
     */
    public function editByKey($assetKey, $params)
    {
        $note = $this->findByKey($assetKey);

        $updated = $note->update($params);

        if (!$updated) {
            throw new Exception('Faied to update the note');
        }

        return $note;
    }

    /**
     * Delete a DB entry by its id and the uploadkey
     *
     * @param $noteId
     * @param $uploadKey
     * @return mixed
     */
    public function deleteByIdAndUploadKey($noteId, $uploadKey)
    {
        return $this->model->where('id', '=', $noteId)->whereHas('upload', function ($q) use ($uploadKey) {
            $q->where('key', '=', $uploadKey);
        })->delete();
    }
}