<?php

use Knoters\Services\SourceHandler;
use Mockery as m;

class SourceHandlerTest extends TestCase
{
    public function testHandle()
    {

    }

    public function testStoreHost()
    {

    }

    public function testStoreRecievers()
    {

    }

    public function testStoreSource()
    {

    }

    public function testStoreEmail()
    {

    }

    public function testGetReceivers()
    {

    }

    public function testGetParam()
    {

    }

    public function testSource()
    {

    }

    public function testGetSourceName()
    {

    }

    public function getSourceHandler($mocks)
    {
        return new SourceHandler($mocks['sourceRepository'], $mocks['uploadRepository'],
            $mocks['uploadEmailRepository']);
    }

    public function getMocks()
    {
        return [
            'uploadRepository'      => m::mock('Knoters\Repositories\UploadRepository'),
            'uploadEmailRepository' => m::mock('Knoters\Repositories\UploadEmailRepository'),
            'sourceRepository'      => m::mock('Knoters\Repositories\SourceRepository')
        ];
    }
}