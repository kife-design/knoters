<?php namespace Knoters\Models;

/**
 * Class Source
 *
 */
class Source extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sources';

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

}