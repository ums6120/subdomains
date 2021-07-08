<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\SuperAdmin;
use App\Models\Admin;
use App\Models\User;

class AdminUsersController extends Controller
{
    public function index()
    {
    	$title = 'Admin Users';
        return view('superadmin.pages.admins',compact('title'));
    }

}
