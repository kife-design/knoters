<?php namespace Knoters\Models;

class Reply extends BaseModel {

	protected $table = 'replies';
    protected $guarded = array('id');
	public $timestamps = true;
	protected $softDelete = true;

	public function note()
	{
		return $this->belongsTo('Knoters\Models\Note');
	}

	public function author()
	{
		return $this->belongsTo('Knoters\Models\User', 'from_id');
	}
}
