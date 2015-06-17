<?php namespace Knoters\Repositories\Eloquent;

use Knoters\Models\Traffic;
use Knoters\Repositories\TrafficRepository;

class TrafficEloquentRepository extends AbstractEloquentRepository implements TrafficRepository
{
    protected $model;

    function __construct(Traffic $model)
    {
        $this->model = $model;
    }
} 