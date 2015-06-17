<?php namespace Knoters\Models;

/**
 * Class Asset
 *
 */
class Asset extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'assets';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array('id');

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Indicates wether the item should be deleted from the database
     * or just get the deleted_at timestamp updated
     *
     * @var bool
     */
    protected $softDelete = false;

    protected $appends = array('large_asset_path', 'small_asset_path');

    /**
     * The upload that is attached to this asset
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function upload()
    {
        return $this->belongsTo('Knoters\Models\Upload');
    }

    /**
     * The notes that have been added to this asset
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany('Knoters\Models\Note');
    }

    /**
     * The paramters that this asset has
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parameters()
    {
        return $this->hasMany('Knoters\Models\AssetParameter');
    }

    /**
     * Returns one of the parameters that match the given $name
     *
     * @param $name
     * @return mixed
     */
    public function getParamVal($name)
    {
        foreach ($this->parameters as $param) {
            if ($param->name == $name) {
                return $param->value;
            }
        }

        return null;
    }

    /**
     * returns the source path of this asset
     * @return string
     */
    public function getSourceAttribute()
    {
        $upload = $this->upload->key;
        return '/uploads/' . $upload;
    }

    public function isSnapshot()
    {
        return $this->getParamVal('type') == 'snapshot';
    }

    public function isSequence()
    {
        return $this->getParamVal('type') == 'sequence';
    }

    public function getLargeAssetPathAttribute()
    {
        return $this->getPath('large', $this->name . '.jpg', true);
    }

    public function getSmallAssetPathAttribute()
    {
        return $this->getPath('small', $this->name . '.jpg', true);
    }

    /**
     * Returns the snapshot path of the asset
     * (only in case this asset is a snapshot)
     *
     * @param bool $relative
     * @return string
     */
    public function snapshotPath($relative = true)
    {
        return $this->getPath('snapshots', $this->name . '.jpg', $relative);
    }

    /**
     * Returns the snapshot path of the asset
     * (only in case this asset is a sequence item
     *
     * @param      $type
     * @param bool $relative
     * @return string
     */
    public function sequencePath($type, $relative = true)
    {
        return $this->getPath('sequences', $this->name . '_' . $type . '.jpg', $relative);
    }

    private function getPath($type, $name, $relative)
    {
        if ($relative) {
            return $this->source . '/' . $type . '/' . $name;
        }

        return $this->upload->uploadPath() . '/' . $type . '/' . $name;
    }
}