<?php namespace Knoters\Transformers;

use Knoters\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * Transform the resource to a new layout
     *
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'token' => $user->uuid,
            'email' => $user->email,
            'firstname' => $user->firstname,
            'name' => $user->name
        ];
    }
}
