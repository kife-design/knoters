<?php namespace Knoters\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

/**
 * Knoters\Models\BaseModel
 *
 * @property-read mixed $crypt
 * @property-read \Illuminate\Database\Eloquent\Collection|\$related[] $morphedByMany
 */
/**
 * Knoters\Models\BaseModel
 *
 * @property-read mixed $crypt
 * @property-read \Illuminate\Database\Eloquent\Collection|\$related[] $morphedByMany
 */
class BaseModel extends Model
{
    public function getCryptAttribute()
    {
        return Crypt::encrypt($this->id);
    }
}