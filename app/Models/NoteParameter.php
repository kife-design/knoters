<?php namespace Knoters\Models;

class NoteParameter extends BaseModel {

	protected $table = 'note_parameters';
	public $timestamps = true;
    protected $guarded = array('id');
	protected $softDelete = false;

	public function note()
	{
		return $this->belongsTo('Knoters\Models\Note');
	}

}