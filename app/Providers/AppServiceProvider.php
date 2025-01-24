<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register a callback to be executed before URL generation
        // Adds clinic slug to routes
        URL::defaults([
            'clinicSlug' => $this->getClinicSlug()
        ]);

    }

    // Function to check if we're on a subdomain
    protected function getClinicSlug(): ?string
    {
        $host = Request::getHost();

        if (str_contains($host, '.localhost')) {
            return explode('.', $host)[0];
        }

        return null;
    }
}
