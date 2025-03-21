<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('staff.dashboard');
    }

    public function login()
    {
        return view('staff.login');
    }
}
