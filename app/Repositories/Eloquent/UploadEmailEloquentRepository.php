<?php namespace Knoters\Repositories\Eloquent;

use Knoters\Models\UploadEmail;
use Knoters\Repositories\UploadEmailRepository;

class UploadEmailEloquentRepository extends AbstractEloquentRepository implements UploadEmailRepository
{
    protected $model;

    function __construct(UploadEmail $model)
    {
        $this->model = $model;
    }
} 