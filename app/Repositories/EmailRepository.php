<?php namespace Knoters\Repositories;

interface EmailRepository extends AbstractRepository
{
    public function getUploadByEmailUrl($url);

    public function findByEmail($email);

    public function addAndGetByEmail($email);
}