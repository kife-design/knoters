<?php

use Illuminate\Support\Facades\Input;


if (!function_exists('user')) {
    /**
     * Return a user from a token that resides in the passed input
     *
     * @return null
     */
    function user()
    {

        if (empty(Input::get('userToken', ''))) {
            return null;
        }
        $userRepository = app()->make(Knoters\Repositories\UserRepository::class);

        return $userRepository->findBy(['uuid' => Input::get('userToken')]);
    }
}

if (!function_exists('project')) {
    /**
     * Return a project from a token that resides in the passed input
     *
     * @return null
     */
    function project()
    {
        if (empty(Input::get('projectToken', ''))) {
            return null;
        }
        $projectRepository = app()->make(Knoters\Repositories\ProjectRepository::class);

        return $projectRepository->findBy(['uuid' => Input::get('projectToken')]);
    }
}

