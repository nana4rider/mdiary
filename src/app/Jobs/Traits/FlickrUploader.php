<?php

namespace App\Jobs\Traits;

use App\Exceptions\FlickrFailedException;
use App\Models\Flickr;
use Rezzza\Flickr\ApiFactory;
use Rezzza\Flickr\Http\GuzzleAdapter;
use Rezzza\Flickr\Metadata;

/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/10/13
 * Time: 23:17
 */
trait FlickrUploader
{
    /**
     * 写真をFlickrにアップロード
     * @param $picture
     * @param null $title
     * @param null $description
     * @param null $tags
     * @return Flickr
     * @throws FlickrFailedException
     */
    public function uploadFlickr($picture, $title = null, $description = null, $tags = null)
    {
        $metadata = new Metadata(config('const.flickr.apikey'), config('const.flickr.secret'));
        $metadata->setOauthAccess(config('const.flickr.oauth_token'), config('const.flickr.oauth_token_secret'));

        $factory = new ApiFactory($metadata, new GuzzleAdapter());

        $upload = $factory->upload($picture, $title, $description, $tags, true);

        if ((string)$upload->attributes()->stat === 'fail') {
            $errAttr = $upload->err->attributes();
            throw new FlickrFailedException((string)$errAttr->msg, (int)$errAttr->code);
        }

        $getInfo = $factory->call('flickr.photos.getInfo', array(
            'photo_id' => (string)$upload->photoid,
        ));

        $photoAttr = $getInfo->photo->attributes();

        $flickr = new Flickr();

        foreach (['id', 'server', 'farm', 'secret'] as $name) {
            $flickr->{'flickr_' . $name} = (string)$photoAttr->$name;
        }

        $flickr->save();

        return $flickr;
    }
}