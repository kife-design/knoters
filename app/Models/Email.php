<?php namespace Knoters\Models;


class Email extends BaseModel
{

    protected $table = 'emails';
    protected $guarded = ['id'];
    public $timestamps = true;
    protected $softDelete = false;

    public function uploads()
    {
        return $this->belongsToMany('Knoters\Models\Upload', 'upload_emails')->withPivot(['url', 'isHost']);
    }

}