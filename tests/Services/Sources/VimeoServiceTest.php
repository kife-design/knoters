<?php

use Knoters\Exceptions\VideoNotFoundException;
use Knoters\Services\Sources\VimeoService;
use SKAgarwal\Reflection\ReflectableTrait;

class VimeoServiceTest extends TestCase
{
    use ReflectableTrait;

    public function testGetValidId()
    {
        $vimeoService = new VimeoService();

        $response = $vimeoService->getId('http://www.vimeo.com/1234');

        $this->assertEquals('1234', $response);
    }

    public function testGetInvalidId()
    {
        $this->setExpectedException(VideoNotFoundException::class);
        $vimeoService = new VimeoService();

        $vimeoService->getId('http://www.vimeo.com/dklfjsl');
    }

    public function testGetValidVideo()
    {
        $vimeoService = new VimeoService();

        $response = $vimeoService->getVideo('1234');

        $this->assertArrayHasKey('status', $response);
        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('description', $response);
        $this->assertArrayHasKey('link', $response);
    }

    public function testGetInvalidVideo()
    {
        $this->setExpectedException(VideoNotFoundException::class);

        $vimeoService = new VimeoService();

        $vimeoService->getVideo('1df234');
    }

    public function testMapValidVideo()
    {
        $vimeoService = new VimeoService();

        $response = $vimeoService->mapVideo(1234);

        $this->assertArrayHasKey('status', $response);
        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('description', $response);
        $this->assertArrayHasKey('link', $response);
    }

    public function testInValidVideo()
    {
        $this->setExpectedException(VideoNotFoundException::class);

        $vimeoService = new VimeoService();

        $vimeoService->mapVideo('1fds234');
    }
}
