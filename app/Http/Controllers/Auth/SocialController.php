<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use App\SocialAccount;


class SocialController extends Controller
{
    
    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that 
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {

        try{
            $user = Socialite::driver($provider)->user();
        }
        catch (Exception $e){
            return redirect('/');
        }
        
        $authUser = $this->findOrCreateUser($user, $provider);
        \Auth::login($authUser, true);
        return redirect('/');
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($userCallback, $provider)
    {

        $authUser = SocialAccount::where('social_id', $userCallback->id)->first();

        if ($authUser) {            
            return $authUser->user;
        }

        $newuser = User::firstOrNew([                    
                    'email'    => $userCallback->email            
                ]);
        if( !$newuser->exists ){
            $newuser->name = $userCallback->name;
        }
        $newuser->save();

        $newuser->socialAccount()->create([
            'provider' => $provider,
            'social_id' => $userCallback->id,
            'nickname' => $userCallback->nickname,
            'avatar' => $userCallback->avatar,

            ]);

        return $newuser;
    }

}
