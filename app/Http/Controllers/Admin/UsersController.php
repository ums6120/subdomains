<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
    	$title = 'Users';
        return view('admin.pages.users',compact('title'));
    }

}
