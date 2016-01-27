<?php

use Knoters\Exceptions\VideoNotFoundException;
use Knoters\Services\Sources\YoutubeService;
use SKAgarwal\Reflection\ReflectableTrait;

class YoutubeServiceTest extends TestCase
{
    use ReflectableTrait;

    public function testGetValidId()
    {
        $youtubeService = new YoutubeService();

        $response = $youtubeService->getId('https://www.youtube.com/watch?v=Sx_4COov1-U');

        $this->assertEquals('Sx_4COov1-U', $response);
    }

    public function testGetInvalidId()
    {
        $this->setExpectedException(VideoNotFoundException::class);
        $youtubeService = new YoutubeService();

        $youtubeService->getId('https://www.youtube.com/watch?v=1234');
    }

    public function testGetValidVideo()
    {
        $youtubeService = new YoutubeService();

        $response = $youtubeService->getVideo('Sx_4COov1-U');

        $this->assertArrayHasKey('status', $response);
        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('description', $response);
        $this->assertArrayHasKey('link', $response);
    }

    public function testGetInvalidVideo()
    {
        $this->setExpectedException(VideoNotFoundException::class);

        $youtubeService = new YoutubeService();

        $youtubeService->getVideo('1234');
    }

    public function testMapValidVideo()
    {
        $youtubeService = new YoutubeService();

        $response = $youtubeService->mapVideo('Sx_4COov1-U');

        $this->assertArrayHasKey('status', $response);
        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('description', $response);
        $this->assertArrayHasKey('link', $response);
    }

    public function testInValidVideo()
    {
        $this->setExpectedException(VideoNotFoundException::class);

        $youtubeService = new YoutubeService();

        $youtubeService->mapVideo('1fds234');
    }
}
