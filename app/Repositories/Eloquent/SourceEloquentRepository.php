<?php namespace Knoters\Repositories\Eloquent;

use Knoters\Models\Source;
use Knoters\Repositories\SourceRepository;

class SourceEloquentRepository extends AbstractEloquentRepository implements SourceRepository
{
    protected $model;

    function __construct(Source $model)
    {
        $this->model = $model;
    }
}