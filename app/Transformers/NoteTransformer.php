<?php namespace Knoters\Transformers;

use Knoters\Models\Note;
use League\Fractal\TransformerAbstract;

class NoteTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'author'
    ];

    protected $availableIncludes = [
        'replies'
    ];


    /**
     * Transform the resource to a new layout
     *
     * @param Note $note
     * @return array
     */
    public function transform(Note $note)
    {
        return [
            'token' => $note->uuid,
            'index' => $note->index,
            'message' => $note->message,
            'postAuthor' => $note->author->email,
            'postDate' => $note->created_at->format('Y-m-d h:i:s'),
            'humanPostDate' => $note->created_at->diffForHumans(),
            'type' => $note->type->type,
            'x' => $note->x,
            'y' => $note->y
        ];
    }

    /**
     * Include the author in de response of the resource
     *
     * @param Note $note
     * @return \League\Fractal\Resource\Item
     */
    public function includeAuthor(Note $note)
    {
        $author = $note->author;

        return $this->item($author, new UserTransformer());
    }

    /**
     * Include the replies in the response of the resource
     *
     * @param Note $note
     * @return \League\Fractal\Resource\Collection
     */
    public function includeReplies(Note $note)
    {
        $replies = $note->replies;

        return $this->collection($replies, new ReplyTransformer);
    }
}
