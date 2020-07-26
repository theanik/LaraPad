<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\User;
class SocialiteController extends Controller
{
    
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try{
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where([['provider_id','=', $user->getId()],['provider','=','facebook']])->first();

            if($finduser){
                Auth::login($finduser);
                return redirect('/home');
            }else{
                $newUser = User::create([
                    'name' => $user->getName(), 
                    'email' => $user->getEmail(),
                    'provider_id' => $user->getId(),
                    'provider' => 'facebook'
                    ]);
                    Auth::login($newUser);
                    return redirect()->back();
            }
        }catch(\Exception $e){
            return "Some thing went wrong";
        }
    }


    public function redirectToGithub()
    {
        // dd("okk");
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        try{
            
            $user = Socialite::driver('github')->user();
            // dd($user);
            $finduser = User::where([['provider_id','=', $user->getId()],['provider','=','github']])->first();

            if($finduser){
                Auth::login($finduser);
                return redirect('/home');
            }else{
                $newUser = User::create([
                    'name' => $user->getName() ?? $user->getNickname(), 
                    'email' => $user->getEmail(),
                    'provider_id' => $user->getId(),
                    'provider' => 'github'
                    ]);
                    Auth::login($newUser);
                    return redirect()->back();
            }
        }catch(\Exception $e){
            return "Some thing went wrong";

        }
    }


    
}
