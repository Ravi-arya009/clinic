<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Support\Facades\Config;

class BootService
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function fetchUserRoles()
    {
        try {
            $roles = Role::pluck('role_id', 'role_name')->toArray();
            Config::set('role', $roles);
        } catch (\Exception $e) {
            Config::set('role', []);
        }
    }
}
