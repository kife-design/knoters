<?php
namespace Knoters\Services\Sources;

use Knoters\Exceptions\VideoNotFoundException;
use Vinkla\Vimeo\Facades\Vimeo;

class VimeoService implements SourceContract
{
    /**
     * Get the video id from a provided vimeo url
     * @param $url
     * @return mixed
     * @throws VideoNotFoundException
     */
    public function getId($url)
    {
        preg_match($this->getIdRegex(), $url, $matches);

        if (count($matches) < 2) {
            throw new VideoNotFoundException();
        }

        return $matches[1];

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
        $video = Vimeo::request('/videos/' . $id, null, 'GET');

        if ($video['status'] == 200) {
            return [
                'status' => 200,
                'name' => $video['body']['name'],
                'description' => $video['body']['description'],
                'link' => $video['body']['link']/*,
                'size' => [
                    'width' => $video['body']['width'],
                    'height' => $video['body']['height']
                ]*/
            ];
        } else {
            throw new VideoNotFoundException('The video could not be found.');
        }
    }

    protected function getIdRegex()
    {

        return '~
			# Match Vimeo link and embed code
			(?:&lt;iframe [^&gt;]*src=")?		# If iframe match up to first quote of src
			(?:							# Group vimeo url
				https?:\/\/				# Either http or https
				(?:[\w]+\.)*			# Optional subdomains
				vimeo\.com				# Match vimeo.com
				(?:[\/\w]*\/videos?)?	# Optional video sub directory this handles groups links also
				\/						# Slash before Id
				([0-9]+)				# $1: VIDEO_ID is numeric
				[^\s]*					# Not a space
			)							# End group
			"?							# Match end quote if part of src
			(?:[^&gt;]*&gt;&lt;/iframe&gt;)?		# Match the end of the iframe
			(?:&lt;p&gt;.*&lt;/p&gt;)?		        # Match any title information stuff
			~ix';
    }
}
