<?php namespace Knoters\Models;

class Project extends BaseModel
{

    /**
     * The table that represents the table
     *
     * @var string
     */

    protected $table = 'projects';

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
  //  protected $timestamps = true;

    /**
     * Indicates wether the item should be deleted from the database
     * or just get the deleted_at timestamp updated
     *
     * @var bool
     */
    protected $softDelete = true;

    protected $dates = [
        'created_at'
    ];

    public function type()
    {
        return $this->belongsTo('Knoters\Models\Source', 'source_id');
    }

    public function status()
    {
        return $this->belongsTo('Knoters\Models\Status', 'status_id');
    }

    public function source()
    {
        return $this->belongsTo(Source::class, 'source_id');
    }

    public function users()
    {
        return $this->belongsToMany('Knoters\Models\User')->withPivot('project_id', 'is_host');
    }

    public function notes()
    {
        return $this->hasMany('Knoters\Models\Note');
    }
}
