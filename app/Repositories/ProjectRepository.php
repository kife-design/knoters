<?php namespace Knoters\Repositories;

interface ProjectRepository extends AbstractRepository
{
    public function findByUuid($uuid);

    public function findByEmail($key);

    public function attachUser($projectId, $userId, $ishost);
}