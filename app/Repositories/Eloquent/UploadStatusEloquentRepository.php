<?php namespace Knoters\Repositories\Eloquent;

use Knoters\Models\UploadStatus;
use Knoters\Repositories\UploadStatusRepository;

class UploadStatusEloquentRepository extends AbstractEloquentRepository implements UploadStatusRepository
{
    protected $model;

    function __construct(UploadStatus $model)
    {
        $this->model = $model;
    }
} 