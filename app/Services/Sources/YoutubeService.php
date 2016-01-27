<?php

namespace Knoters\Services\Sources;

use Alaouy\Youtube\Facades\Youtube;
use Knoters\Exceptions\VideoNotFoundException;

class YoutubeService implements SourceContract
{
    /**
     * Get the videoId from a provided youtube url
     *
     * @param $url
     * @return mixed
     */
    public function getId($url)
    {
        $id =  Youtube::parseVIdFromURL($url);

        $this->getVideo($id);

        return $id;
    }

    /**
     * Get a video from an id
     *
     * @param $id
     *
     * @return array
     */
    public function getVideo($id)
    {
        return $this->mapVideo($id);
    }

    /**
     * Map the video to a new layout
     *
     * @param $id
     * @return array
     * @throws VideoNotFoundException
     */
    public function mapVideo($id)
    {
        $video = Youtube::getVideoInfo($id);

        if ($video) {
            return [
                'status' => 200,
                'name' => $video->snippet->title,
                'description' => $video->snippet->description,
                'link' => 'http://www.youtube.com/watch?v=' . $id
            ];
        } else {
            throw new VideoNotFoundException('The video could not be found.');
        }
    }
}
