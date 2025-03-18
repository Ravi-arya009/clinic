<?php

namespace App\Http\Controllers;

use App\Models\Clinic;

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
