<?php namespace Knoters\Models;

class Note extends BaseModel
{

    protected $table = 'notes';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $softDelete = false;

    protected $appends = ['x', 'y'];

    public function parameters()
    {
        return $this->hasMany('Knoters\Models\NoteParameter');
    }

    public function upload()
    {
        return $this->belongsTo('Knoters\Models\Upload');
    }

    public function asset()
    {
        return $this->belongsTo('Knoters\Models\Asset');
    }

    public function sender()
    {
        return $this->belongsTo('Knoters\Models\Email', 'from_id');
    }

    public function replies()
    {
        return $this->hasMany('Knoters\Models\Reply');
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