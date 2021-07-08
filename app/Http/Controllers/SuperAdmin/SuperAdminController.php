<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\SuperAdmin;
use App\Models\Admin;
use App\Models\User;

class SuperAdminController extends Controller
{

    public function index()
    {
    	$title = 'Dashboard';
        return view('superadmin.pages.dashboard',compact('title'));
    }

    protected function guard()
    {
        return Auth::guard('superadmin');
    }

    public function logout(Request $request){

    	$this->guard('superadmin')->logout();
        $request->session()->invalidate();

        return redirect()->route('login')->with('success','You have been logged out.');
    }

}
