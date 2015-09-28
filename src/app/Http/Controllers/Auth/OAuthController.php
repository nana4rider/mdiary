<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/28
 * Time: 20:01
 */

namespace App\Http\Controllers\Auth;

use AdamWathan\EloquentOAuth\Facades\OAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use SocialNorm\Exceptions\ApplicationRejectedException;
use SocialNorm\Exceptions\InvalidAuthorizationCodeException;

class OAuthController extends Controller
{
    /**
     * @param $provider
     * @return mixed
     */
    public function getAuthorize($provider)
    {
        if (!array_key_exists($provider, config('eloquent-oauth.providers'))) {
            return Redirect::intended();
        }

        return OAuth::authorize($provider);
    }

    /**
     * @param $provider
     * @return mixed
     */
    public function getLogin($provider)
    {
        try {
            OAuth::login($provider, function ($user, $details) {
                $user->name = $details->full_name;
                $user->email = $details->email;
                $user->save();
            });
        } catch (ApplicationRejectedException $e) {
            // User rejected application
        } catch (InvalidAuthorizationCodeException $e) {
            // Authorization was attempted with invalid
            // code,likely forgery attempt
        }

        return Redirect::intended();
    }
}