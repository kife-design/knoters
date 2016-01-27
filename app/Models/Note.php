<?php namespace Knoters\Models;

class Note extends BaseModel
{

    protected $table = 'notes';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $softDelete = true;

    protected $appends = ['x', 'y'];

    public function parameters()
    {
        return $this->hasMany('Knoters\Models\NoteParameter');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function asset()
    {
        return $this->belongsTo('Knoters\Models\Asset');
    }

    public function author()
    {
        return $this->belongsTo('Knoters\Models\User', 'from_id');
    }

    public function replies()
    {
        return $this->hasMany('Knoters\Models\Reply');
    }

    public function type()
    {
        return $this->belongsTo('Knoters\Models\NoteType', 'note_type_id');
    }

    public function getXAttribute()
    {
        return $this->getParamVal('x');
    }

    public function getYAttribute()
    {
        return $this->getParamVal('y');
    }

    public function getParamVal($name)
    {
        foreach ($this->parameters as $param) {
            if ($param->name == $name) {
                return $param->value;
            }
        }
    }
}
