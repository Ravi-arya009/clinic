<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\temp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use illuminate\Support\Str;

class TempController extends Controller
{

    public function index()
    {
        return view('temp');


    }

    public function temp(){
        $doctors =Doctor::with('qualification')->limit(5)->get();
        dd($doctors);
    }

}
