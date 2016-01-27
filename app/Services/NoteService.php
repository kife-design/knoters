<?php namespace Knoters\Services;


use Knoters\Repositories\NoteParameterRepository;
use Knoters\Repositories\NoteRepository;
use Webpatser\Uuid\Uuid;

class NoteService
{
    /**
     * @var NoteRepository
     */
    private $noteRepository;
    /**
     * @var NoteParameterRepository
     */
    private $noteParameterRepository;

    /**
     * NoteService constructor.
     *
     * @param NoteRepository $noteRepository
     * @param NoteParameterRepository $noteParameterRepository
     */
    public function __construct(
        NoteRepository $noteRepository,
        NoteParameterRepository $noteParameterRepository
    )
    {
        $this->noteRepository = $noteRepository;
        $this->noteParameterRepository = $noteParameterRepository;
    }

    /**
     * Get all notes for a provided project from the database
     *
     * @param $project
     * @return mixed
     */
    public function getByProject($project)
    {
        return $this->noteRepository->getByProjectId($project->id);
    }

    public function getByProjectAndSearch($project, $searchValues)
    {
        return $this->noteRepository->getByProjectIdAndSearch($project->id, $searchValues);
    }

    /**
     * Store a new note in the database
     *
     * @param $data
     * @return static
     * @throws \Exception
     */
    public function store($data)
    {
        $note = $this->noteRepository->store([
            'index' => $data['index'],
            'project_id' => project()->id,
            'from_id' => user()->id,
            'note_type_id' => 1,
            'uuid' => (string)Uuid::generate(4)
        ]);

        $this->storeParams($note->id, $data['position']);

        return $note;
    }

    /**
     * Store the parameters of a note to the database
     *
     * @param $noteId
     * @param $items
     */
    private function storeParams($noteId, $items)
    {
        foreach ($items as $name => $value) {
            $item = $this->noteParameterRepository->findByNoteAndName($noteId, $name, [], ['id']);

            if (is_null($item)) {
                $this->noteParameterRepository->store([
                    'note_id' => $noteId,
                    'name' => $name,
                    'value' => $value
                ]);
            } else {
                $this->noteParameterRepository->update($item->id, [
                    'value' => $value
                ]);
            }
        }
    }

    /**
     * Update a note in the database
     *
     * @param $uuid
     * @param $params
     * @return mixed
     */
    public function update($uuid, $params)
    {
        $note = $this->noteRepository->findByUuid($uuid);

        foreach ($params as $key => &$param) {
            if ($key == 'type') {
                $param = constant('Knoters\Models\NoteType::' . strtoupper($param));
            } else {
                if ($key == 'items') {
                    $this->saveNoteItems($note->id, $param);
                    unset($params['items']);
                }
            }
        }

        return $this->noteRepository->update($note->id, $params);
    }

    /**
     * Delete a note from the database
     *
     * @param $uuid
     * @return mixed
     */
    public function delete($uuid)
    {
        return $this->noteRepository->deleteByUuid($uuid);
    }
}
