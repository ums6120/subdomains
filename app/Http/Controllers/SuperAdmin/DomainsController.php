<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Domain;
use App\Models\Admin;
use App\Models\User;

class DomainsController extends Controller
{
    public function index()
    {
    	$title = 'Domains List';
        return view('superadmin.pages.domains',compact('title'));
    }

}
