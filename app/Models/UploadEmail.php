<?php namespace Knoters\Models;

class UploadEmail extends BaseModel
{
    const IS_HOST = 1;
    const IS_NOT_HOST = 0;

    protected $table = 'upload_emails';
    protected $guarded = ['id'];
    public $timestamps = true;
    protected $softDelete = true;
} 