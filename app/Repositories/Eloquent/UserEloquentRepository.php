<?php namespace Knoters\Repositories\Eloquent;

use Knoters\Models\User;
use Knoters\Repositories\UserRepository;

class UserEloquentRepository extends AbstractEloquentRepository implements UserRepository
{
    protected $model;

    function __construct(User $model)
    {
        $this->model = $model;
    }
} 