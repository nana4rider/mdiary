<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/28
 * Time: 20:01
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Redirect;
use SocialAuth;
use SocialNorm\Exceptions\ApplicationRejectedException;
use SocialNorm\Exceptions\InvalidAuthorizationCodeException;

class SocialAuthController extends Controller
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

        return SocialAuth::authorize($provider);
    }

    /**
     * @param $provider
     * @return mixed
     */
    public function getLogin($provider)
    {
        try {
            SocialAuth::login($provider, function ($user, $details) {
                if (is_null($user->id)) {
                    // 初回登録時の項目
                    $user->group_id = Group::GUEST;
                }

                $name = $details->full_name ?: $details->nickname;

                $user->name = $name;
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