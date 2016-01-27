<?php namespace Knoters\Repositories\Eloquent;

use Knoters\Models\Project;
use Knoters\Repositories\ProjectRepository;

class ProjectEloquentRepository extends AbstractEloquentRepository implements ProjectRepository
{
    protected $model;

    function __construct(Project $model)
    {
        $this->model = $model;
    }

    public function findByUuid($uuid)
    {
        return $this->model->where('uuid', $uuid)->first();
    }


    public function findByEmail($key)
    {
        return $this->model->where('email', $key)->first();
    }

    public function attachUser($projectId, $userId, $isHost)
    {
        $project = $this->model->find($projectId);

        if (!$project->users->contains($userId)) {
            $project->users()->attach($userId, ['is_host' => $isHost]);
        }

        return 'ok';
    }
}
