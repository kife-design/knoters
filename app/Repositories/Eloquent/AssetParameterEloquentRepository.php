<?php namespace Knoters\Repositories\Eloquent;

use Knoters\Repositories\AssetParameterRepository;
use Knoters\Models\AssetParameter;

class AssetParameterEloquentRepository extends AbstractEloquentRepository implements AssetParameterRepository
{
    protected $model;

    function __construct(AssetParameter $model)
    {
        $this->model = $model;
    }


    /**
     * @param $id
     * @param $data
     * @throws \Exception
     */
    public function storeBulk($id, $data)
    {
        try {
            foreach ($data as $key => $item) {
                $saved = $this->store(array(
                    'asset_id' => $id,
                    'name' => $key,
                    'value' => $item
                ));
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
}