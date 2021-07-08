<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Modles\User;
use App\Modles\Admin;
use App\Modles\SuperAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Cache\RateLimiter;

class LoginController extends Controller
{
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $title = "Sign In";
        return view('auth.login', compact('title'));
    }


    public function login(Request $request)
    {

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if (Auth::attempt(['email' => $request->email,'password' => $request->password])
        ){
            return redirect(route('user.dashboard'))->with('success','Successfully loggedin.');
        } elseif (Auth::guard('admin')->attempt(['email' => $request->email,'password' => $request->password])) {
            // dd(Auth::guard('admin'));
                if(auth()->guard('admin')->user()->domain && isset(auth()->guard('admin')->user()->domain->name)) {
                    return redirect(route('admin.dashboard',auth()->guard('admin')->user()->domain->name))->with('success','Successfully loggedin.');
                }
                return redirect(route('admin.dashboard'))->with('success','Successfully loggedin.');
        }elseif(Auth::guard('superadmin')->attempt(['email' => $request->email,'password' => $request->password])) {
                return redirect(route('superadmin.dashboard'))->with('success','Successfully loggedin.');
        }
        return redirect(route('login'))->with('error', 'Invalid Login.');
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);


        return $this->sendFailedLoginResponse($request);
    }

    public function username()
    {
        return 'email';
    }

    protected function validateLogin(Request $request)
    {
        $validation_rule = [
            'email' => 'required|string',
            'password' => 'required|string',
        ];

        $request->validate($validation_rule);
    }

    public function logout(Request $request)
    {
        return $this->logoutGet();
    }

    public function logoutGet()
    {
        $this->guard()->logout();

        request()->session()->invalidate();

        return redirect()->route('login')->with('success','You have been logged out.');
    }

    protected function sendRequest()
    {
        if ($this->hasTooManyLoginAttempts()) {
            // wait
            sleep(
                $this->limiter()
                    ->availableIn($this->throttleKey()) + 1 // <= optional plus 1 sec to be on safe side
            );

            // Call this function again.
            return $this->sendRequest();
        }
        
        //proceed to api call
        $response = apiCall();

        // Increment the attempts
        $this->limiter()->hit(
            $this->throttleKey(), 60 // <= 60 seconds
        );

        return $response;
    }

    /**
     * Determine if we made too many requests.
     *
     * @return bool
     */
    protected function hasTooManyLoginAttempts()
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey(), 25 // <= max attempts per minute
        );
    }

    /**
     * Get the rate limiter instance.
     *
     * @return \Illuminate\Cache\RateLimiter
     */
    protected function limiter()
    {
        return app(RateLimiter::class);
    }

    /**
     * Get the throttle key for the given request.
     *
     * @return string
     */
    protected function throttleKey()
    {
        return 'custom_api_request';
    }
}
