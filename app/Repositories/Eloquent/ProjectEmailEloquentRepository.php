<?php namespace Knoters\Repositories\Eloquent;

use Knoters\Models\ProjectEmail;
use Knoters\Repositories\ProjectEmailRepository;

class ProjectEmailEloquentRepository extends AbstractEloquentRepository implements ProjectEmailRepository
{
    protected $model;

    function __construct(ProjectEmail $model)
    {
        $this->model = $model;
    }
} 