<?php

namespace App\Models;

use App\Models\Traits\UserInfo;
use Illuminate\Database\Eloquent\Model;

class Flickr extends Model
{
    use UserInfo;

    /**
     * s    small square 75x75
     * t    thumbnail, 100 on longest side
     * m    small, 240 on longest side
     * z    medium 640, 640 on longest side
     * b    large, 1024 on longest side*
     *
     * @param null $size [mstzb]
     * @return string
     */
    private function getUrl($size = null)
    {
        $url = 'https://farm' . $this->flickr_farm . '.staticflickr.com/';
        $url .= $this->flickr_server . '/' . $this->flickr_id . '_' . $this->flickr_secret;
        if (!is_null($size)) {
            $url .= '_' . $size;
        }
        $url .= '.jpg';

        return $url;
    }

    public function getImageUrlAttribute()
    {
        return $this->getUrl('b');
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->getUrl('m');
    }
}
