<?php namespace Knoters\Repositories\Eloquent;

use Knoters\Models\NoteParameter;
use Knoters\Repositories\NoteParameterRepository;

class NoteParameterEloquentRepository extends AbstractEloquentRepository implements NoteParameterRepository
{
    protected $model;

    public function __construct(NoteParameter $model)
    {
        $this->model = $model;
    }


    public function findByNoteAndName($noteId, $name) {
        return $this->model->where('note_id', $noteId)->where('name', $name)->first();
    }

    /**
     * @param $id
     * @param $data
     * @throws Exception
     * @throws \Exception
     */
    public function updateBulk($id, $data)
    {
        try {
            $paramsArray = array();
            foreach ($data as $key => $item) {
                $noteParam = NoteParameter::where('note_id', '=', $id)
                    ->where('name', '=', $key)->first();
                $updated = $noteParam->update(array('value' => $item));

                if (! $updated) {
                    throw new Exception ('Failed to update a note parameter');
                }

                array_push($paramsArray, $noteParam);
            }

            return $paramsArray;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * stores multiple records by the given id and data
     * @param $id
     * @param $data
     */
    public function storeBulk($id, $data)
    {
        try {
            $paramsArray = array();
            foreach ($data as $key => $item) {
                $noteParam = $this->store(array(
                    'note_id' => $id,
                    'name' => $key,
                    'value' => $item
                ));

                array_push($paramsArray, $noteParam);
            }

            return $paramsArray;
        } catch (Exception $e) {
            throw $e;
        }
    }
}