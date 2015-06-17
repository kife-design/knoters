<?php namespace Knoters\Models;

class AssetParameter extends BaseModel
{

    protected $table = 'asset_parameters';
    protected $guarded = ['id'];
    public $timestamps = true;
    protected $softDelete = false;

    public function asset()
    {
        return $this->belongsTo('Knoters\Models\Asset');
    }
}