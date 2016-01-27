<?php namespace Knoters\Transformers;

use Knoters\Models\Reply;
use League\Fractal\TransformerAbstract;

class ReplyTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'author'
    ];

    /**
     * Transform the resource to a new layout
     *
     * @param Reply $reply
     * @return array
     */
    public function transform(Reply $reply)
    {
        return [
            'token' => $reply->uuid,
            'index' => $reply->index,
            'message' => $reply->message,
            'postDate' => $reply->created_at->format('Y-m-d h:i:s'),
            'humanPostDate' => $reply->created_at->diffForHumans(),
        ];
    }

    /**
     * Include the author in de response of the resource
     *
     * @param Reply $reply
     * @return \League\Fractal\Resource\Item
     */
    public function includeAuthor(Reply $reply)
    {
        $author = $reply->author;

        return $this->item($author, new UserTransformer());
    }
}
