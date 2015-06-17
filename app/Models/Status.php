<?php namespace Knoters\Models;


class Status extends BaseModel {
    const CREATE = 1;

	protected $table = 'status';
	public $timestamps = true;
	protected $softDelete = false;

}