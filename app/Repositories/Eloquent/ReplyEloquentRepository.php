<?php namespace Knoters\Repositories\Eloquent;

use Knoters\Models\Reply;
use Knoters\Repositories\ReplyRepository;

/**
 * Class ReplyEloquentRepository
 * @package Knoters\Repositories\Eloquent
 */
class ReplyEloquentRepository extends AbstractEloquentRepository implements ReplyRepository
{
    /**
     * @var Reply
     */
    protected $model;

    /**
     * @param Reply $model
     */
    function __construct(Reply $model)
    {
        $this->model = $model;
    }

    /**
     * @param $noteId
     * @param $replyIndex
     * @return mixed
     */
    public function findByNoteAndIndex($noteId, $replyIndex)
    {
        return $this->model->where('note_id', '=', $noteId)
            ->where('index', '=', $replyIndex)
            ->first();
    }

    public function editByNoteAndIndex($noteId, $index, $attributes) {
        $reply = $this->findByNoteAndIndex($noteId, $index);

        $updated = $reply->update($attributes);

        if (!$updated) {
            throw new Exception('Faied to update the note');
        }

        return $reply;
    }
}