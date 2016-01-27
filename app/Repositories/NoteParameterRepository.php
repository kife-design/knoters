<?php namespace Knoters\Repositories;

interface NoteParameterRepository extends AbstractRepository
{
    public function findByNoteAndName($noteId, $name);

    public function updateBulk($id, $data);

    public function storeBulk($id, $data);
}