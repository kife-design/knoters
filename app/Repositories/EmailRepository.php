<?php namespace Knoters\Repositories;

interface EmailRepository extends AbstractRepository
{
    public function getProjectByEmailUrl($url);

    public function findByEmail($email);

    public function addAndGetByEmail($email);
}