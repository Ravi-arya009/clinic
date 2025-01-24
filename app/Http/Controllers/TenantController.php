<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TenantController extends Controller
{
    public function landing($slug)
    {
        $clinic = Clinic::where('slug', $slug)->first();
        if (!$clinic) {
            abort(404);
        }
        return view('clinic_landing', ['clinicName' => ucfirst($clinic->name)]);
    }
}
