<?php namespace Knoters\Models;

class NoteType extends BaseModel
{
    const INFO = 1;
    const SUCCESS = 2;
    const ERROR = 3;

    protected $table = 'note_types';

    protected $guarded = ['type'];
}
