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
     * Find a colection item by its key
     * @param $key
     * @return mixed
     */
    public function findByKey($key)
    {
        return $this->model->where('key', '=', $key)->first();
    }

    /**
     * Gets a collection of assets by a given upload id
     *
     * @param $uploadId
     * @param $with
     * @return mixed
     */
    public function getByUploadId($uploadId, $with)
    {
        $query = $this->make($with);

        return $query->where('upload_id', '=', $uploadId)->get();
    }


}