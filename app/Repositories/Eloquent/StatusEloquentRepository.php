<?php namespace Knoters\Repositories\Eloquent;

use Knoters\Models\Status;
use Knoters\Repositories\StatusRepository;

class StatusEloquentRepository extends AbstractEloquentRepository implements StatusRepository
{
    protected $model;

    function __construct(Status $model)
    {
        $this->model = $model;
    }
} 