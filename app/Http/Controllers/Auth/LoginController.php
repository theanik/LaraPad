<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{

    protected $maxAttempts = 3;
    protected $decayMinutes = 10;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers , ThrottlesLogins;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    
    public function login(Request $request)
    {

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
           return redirect()->intended('home');
        }else{

            $key = $this->throttleKey($request);
            $rateLimiter = $this->limiter();

            if ($this->hasTooManyLoginAttempts($request)) {

                    $attempts = $rateLimiter->attempts($key); 

                    $limit = [3 => 10, 5 => 30];

                    if($attempts >= 5)
                    {
                        $rateLimiter->clear($key);;
                    }

                    if(array_key_exists($attempts, $limit)){
                        $this->decayMinutes = $limit[$attempts];
                    }
                    
                    $this->incrementLoginAttempts($request);

                    $this->fireLockoutEvent($request);
                return $this->sendLockoutResponse($request);

                }

                $this->incrementLoginAttempts($request);
            return $this->sendFailedLoginResponse($request);
        }
        
    }


    public function __construct(Request $request)
    {
        $this->middleware('guest')->except('logout');
    }
}
