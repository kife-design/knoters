<?php namespace Knoters\Models;

class Traffic extends BaseModel {

	protected $table = 'traffic';
    protected $guarded = array('id');
	public $timestamps = true;
	protected $softDelete = false;

	public function project()
	{
		return $this->hasOne('Knoters\Models\Project');
	}

	public function sender()
	{
		return $this->belongsTo('Knoters\Models\Email', 'sender_id');
	}

	public function receiver()
	{
		return $this->belongsTo('Knoters\Models\Email', 'receiver_id');
	}

}