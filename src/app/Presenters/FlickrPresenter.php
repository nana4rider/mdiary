<?php

namespace App\Presenters;

use McCool\LaravelAutoPresenter\BasePresenter;

/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/10/10
 * Time: 16:46
 */
class FlickrPresenter extends BasePresenter
{
    /**
     * @param null $size [mstzb]
     * @return string
     */
    public function url($size = null)
    {
        $url = 'https://farm' . $this->flickr_farm . '.staticflickr.com/';
        $url .= $this->flickr_server . '/' . $this->flickr_id . '_' . $this->flickr_secret;
        if (!is_null($size)) {
            $url .= '_' . $size;
        }
        $url .= '.jpg';

        return $url;
    }
}