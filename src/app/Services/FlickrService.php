<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/10/10
 * Time: 11:03
 */

namespace App\Services;


use App\Exceptions\FlickrFailedException;
use App\Models\Flickr;
use Rezzza\Flickr\ApiFactory;
use Rezzza\Flickr\Http\GuzzleAdapter;
use Rezzza\Flickr\Metadata;

class FlickrService
{
    /**
     * Flickrにファイルをアップロードします。
     *
     * @param $path
     * @param null $title
     * @param null $description
     * @param null $tags
     * @throws FlickrFailedException
     * @return Flickr
     */
    public function upload($path, $title = null, $description = null, $tags = null)
    {
        $metadata = new Metadata(config('const.flickr.apikey'), config('const.flickr.secret'));
        $metadata->setOauthAccess(config('const.flickr.oauth_token'), config('const.flickr.oauth_token_secret'));

        $factory = new ApiFactory($metadata, new GuzzleAdapter());

        $upload = $factory->upload($path, $title, $description, $tags, true);

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