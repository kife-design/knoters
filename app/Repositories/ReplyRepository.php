<?php namespace Knoters\Repositories;

interface ReplyRepository extends AbstractRepository
{
    public function findByNoteAndIndex($noteId, $replyIndex);
} 