<?php namespace Knoters\Repositories\Eloquent;

use Knoters\Models\ProjectStatus;
use Knoters\Repositories\ProjectStatusRepository;

class ProjectStatusEloquentRepository extends AbstractEloquentRepository implements ProjectStatusRepository
{
    protected $model;

    function __construct(ProjectStatus $model)
    {
        $this->model = $model;
    }
} 