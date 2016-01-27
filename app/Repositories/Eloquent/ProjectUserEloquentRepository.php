<?php namespace Knoters\Repositories\Eloquent;

use Knoters\Models\ProjectUser;
use Knoters\Repositories\ProjectUserRepository;

class ProjectUserEloquentRepository extends AbstractEloquentRepository implements ProjectUserRepository
{
    protected $model;

    function __construct(ProjectUser $model)
    {
        $this->model = $model;
    }
} 