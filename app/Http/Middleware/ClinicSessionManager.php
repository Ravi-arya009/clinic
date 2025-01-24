<?php

namespace App\Http\Middleware;

use App\Models\Clinic;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;


class ClinicSessionManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $clinicSlug = $request->route('clinicSlug');

        if (Session::has('current_clinic') && Session::get('current_clinic.slug') === $clinicSlug) {
            return $next($request);
        }

        $clinic = Clinic::where('slug', $clinicSlug)->first();

        if (!$clinic) {
            abort(404, 'Clinic not found');
        }

        Session::put('current_clinic', [
            'id' => $clinic->id,
            'slug' => $clinicSlug,
        ]);

        return $next($request);
    }
}
