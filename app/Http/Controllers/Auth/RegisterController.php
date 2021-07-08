<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Jobs\WelcomeEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function showRegistrationForm($ref = null)
    {
        $title = "Sign Up";
        return view('auth.register', compact('title'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validate =  Validator::make($data, [
            'name' => 'required|string|max:120',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'min:6|required_with:confirmpassword|same:confirmpassword',
            'confirmpassword' => 'min:6'
        ]);
        return $validate;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        dispatch(new WelcomeEmailJob($user = $this->create($request->all())));
        $this->guard('user')->login($user);

        return redirect()->route('user.dashboard');
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }

    public function registered()
    {
        return redirect()->route('user.dashboard');
    }

    protected function guard()
    {
        return Auth::guard('user');
    }
}
