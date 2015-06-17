<?php namespace Knoters\Models;

class Reply extends BaseModel {

	protected $table = 'replies';
    protected $guarded = array('id');
	public $timestamps = true;
	protected $softDelete = false;

	public function note()
	{
		return $this->belongsTo('Knoters\Models\Note');
	}

	public function sender()
	{
		return $this->belongsTo('Knoters\Models\Email', 'sender_id');
	}

}