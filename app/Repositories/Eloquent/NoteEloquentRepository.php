<?php namespace Knoters\Repositories\Eloquent;

use Exception;
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
     * @param $projectId
     * @param array $relations
     * @param array $columns
     * @return mixed
     */
    public function getByProjectId($projectId, $relations = [], $columns = ['*'])
    {
        $resources = $this->make($relations);

        return $resources->where('project_id', '=', $projectId)->get($columns);
    }

    /**
     * @param $projectId
     * @param $searchvalues
     * @param array $relations
     * @param array $columns
     * @return mixed|void
     */
    public function getByProjectIdAndSearch($projectId, $searchvalues, $relations = [], $columns = ['*'])
    {
        $resources = $this->make($relations);

        $resources->where('project_id', $projectId);

        foreach ($searchvalues as $searchvalue) {
            if (!empty($searchvalue['value'])) {
                switch ($searchvalue['name']) {
                    case 'message':
                        $resources->where('message', 'like', '%' . $searchvalue['value'] . '%');
                        break;
                    case 'author':
                        $resources->whereHas('author', function ($q) use ($searchvalue) {
                            $q->where('email', $searchvalue['value']);
                        });
                        break;
                    case 'type':
                        $resources->whereHas('type', function ($q) use ($searchvalue) {
                            $q->where('type', $searchvalue['value']);
                        });
                        break;
                }
            }
        }

        return $resources->get($columns);
    }


    /**
     * Get a collection item by key and index
     *
     * @param string $uuid
     * @param array $relations
     * @param array $columns
     * @return Note
     */
    public function findByUuid($uuid, $relations = [], $columns = ['*'])
    {
        return $this->make($relations)->where('uuid', '=', $uuid)->first($columns);
    }

    /**
     * Edit a DB entry by key and index
     *
     * @param $assetKey
     * @param $params
     * @return mixed
     * @throws Exception
     * @internal param $index
     */
    public function editByKey($assetKey, $params)
    {
        $note = $this->findByKey($assetKey);

        $updated = $note->update($params);

        if (!$updated) {
            throw new Exception('Failed to update the resource');
        }

        return $note;
    }

    /**
     * Delete a DB entry by its uuid
     *
     * @param $uuid
     * @return mixed
     * @throws Exception
     */
    public function deleteByUuid($uuid)
    {
        $deleted = $this->model->where('uuid', '=', $uuid)->delete();

        if (!$deleted) {
            throw new Exception('Failed to remove the resource');
        }
    }
}