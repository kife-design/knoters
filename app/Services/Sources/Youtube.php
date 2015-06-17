<?php

namespace Knoters\Services\Sources;

use Alaouy\Youtube\Facades\Youtube as YoutubeService;

class Youtube implements SourceContract
{
    /**
     * @param $url
     * @return mixed
     */
    public function getId($url)
    {
        return YoutubeService::parseVIdFromURL($url);
    }
}