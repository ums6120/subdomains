<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
    	$title = 'Dashboard';
        return view('admin.pages.dashboard',compact('title'));
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function logout(Request $request){

    	$this->guard('admin')->logout();
        $request->session()->invalidate();

        return redirect()->route('login')->with('success','You have been logged out.');
    }
}
