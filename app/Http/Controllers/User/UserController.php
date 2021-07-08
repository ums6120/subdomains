<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
    	$title = 'Dashboard';
        return view('user.pages.dashboard',compact('title'));
    }

    protected function guard()
    {
        return Auth::guard('user');
    }

    public function logout(Request $request){

    	$this->guard('user')->logout();
        $request->session()->invalidate();

        return redirect()->route('login')->with('success','You have been logged out.');
    }
}
