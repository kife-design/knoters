<?php

namespace Knoters\Models;


class ProjectUser extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_user';

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
