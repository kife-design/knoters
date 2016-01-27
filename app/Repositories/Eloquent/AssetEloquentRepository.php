<?php namespace Knoters\Repositories\Eloquent;

use Knoters\Repositories\AssetRepository;
use Knoters\Models\Asset;

class AssetEloquentRepository extends AbstractEloquentRepository implements AssetRepository
{
    protected $model;

    public function __construct(Asset $model)
    {
        $this->model = $model;
    }

    /**
     * Gets a collection of assets by a given project id
     *
     * @param $projectId
     * @param $with
     * @return mixed
     */
    public function getByProjectId($projectId, $with)
    {
        $query = $this->make($with);

        return $query->where('project_id', '=', $projectId)->get();
    }


}