<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use App\Models\User;


class AuthController extends Controller
{
    public function oauth(Request $request)
    {
        if ($request->driver=='github')
        {
            return Socialite::driver('github')->redirect();
        }else if ($request->driver=='wechat')
        {
            return \Socialite::with('weixin')->redirect();
        }
    }

    public function oauthcallback()
    {

        try {
            $user = Socialite::driver('github')->user();
        } catch (Exception $e) {
            return Redirect::to('auth/oauth?driver=github');
        }

        $authUser = $this->findOrCreateUser($user,'github');

        Auth::login($authUser, true);

        return redirect('/');
    }

    public function wechatcallback()
    {
        try {
            $user = \Socialite::driver('weixin')->user();
        } catch (Exception $e) {
            return Redirect::to('auth/oauth?driver=wechat');
        }
        $authUser = $this->findOrCreateUser($user,'wechat');

        Auth::login($authUser, true);

        return redirect('/');

    }
    private function findOrCreateUser($userinfo,$type)
    {
        switch ($type){
            case 'github':
                if ($authUser = User::where('github_id', $userinfo->id)->first()) {
                    return $authUser;
                }

                return User::create([
                    'name' => $userinfo->name,
                    'email' => $userinfo->email,
                    'github_id' => $userinfo->id,
                    'avatar' => $userinfo->avatar,
                    'password' =>bcrypt('password'), // secret
                    'remember_token' => str_random(10),
                ]);
                break;
            case 'wechat':
                if ($authUser = User::where('wechat_id', $userinfo->id)->first()) {
                    return $authUser;
                }
                return User::create([
                    'name' => $userinfo->nickname,
                    'email' => $userinfo->email,
                    'wechat_id' => $userinfo->id,
                    'avatar' => $userinfo->avatar,
                    'password' =>bcrypt('password'), // secret
                    'remember_token' => str_random(10),
                ]);
                break;

        }

    }
}
