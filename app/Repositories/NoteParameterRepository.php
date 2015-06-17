<?php namespace Knoters\Repositories;

interface NoteParameterRepository extends AbstractRepository
{
    public function updateBulk($id, $data);

    public function storeBulk($id, $data);
}