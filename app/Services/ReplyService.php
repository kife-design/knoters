<?php namespace Knoters\Services;

use Knoters\Repositories\NoteRepository;
use Knoters\Repositories\ReplyRepository;
use Webpatser\Uuid\Uuid;

class ReplyService
{
    /**
     * @var NoteRepository
     */
    private $noteRepository;
    /**
     * @var ReplyRepository
     */
    private $replyRepository;

    /**
     * @param NoteRepository $noteRepository
     * @param ReplyRepository $replyRepository
     */
    public function __construct(NoteRepository $noteRepository, ReplyRepository $replyRepository)
    {

        $this->noteRepository = $noteRepository;
        $this->replyRepository = $replyRepository;
    }

    /**
     * Store a new reply to the database
     *
     * @param $data
     * @return static
     * @throws \Exception
     */
    public function store($data)
    {
        $note = $this->noteRepository->findByUuid($data['noteUuid'], [], ['id']);

        return $this->replyRepository->store([
            'note_id' => $note->id,
            'index'   => $data['index'],
            'from_id' => user()->id,
            'uuid'    => (string)Uuid::generate(4)

        ]);
    }

    /**
     * Update a reply to the database
     *
     * @param $uuid
     * @param $params
     * @return static
     */
    public function update($uuid, $params)
    {
        $replyId = $this->replyRepository->pluckBy('uuid', $uuid, 'id');

        return $this->replyRepository->update($replyId, $params);
    }
}
