<?php namespace Knoters\Repositories\Eloquent;

use Knoters\Models\Upload;
use Knoters\Repositories\UploadRepository;

class UploadEloquentRepository extends AbstractEloquentRepository implements UploadRepository
{
    protected $model;

    function __construct(Upload $model)
    {
        $this->model = $model;
    }

    /**
     * returns an Upload isntance by a given uploadkey
     *
     * @param $key
     * @return static
     */
    public function findByKey($key)
    {
        return  Upload::where('key', '=', $key)->first();
    }

    /**
     * returns an upload by a given key, all relations are passed aswell
     *
     * @param $key
     * @return mixed
     */
    public function findByKeyWithRelations($key, $relations)
    {
        return Upload::where('key', '=', $key)
            ->with($relations)
            ->first();
    }

    public function findByUploadEmailKey($key)
    {
        return Upload::with('emails')->whereHas('emails', function ($q) use ($key) {
            $q->where('upload_emails.url', $key);
        })->first();
    }


}