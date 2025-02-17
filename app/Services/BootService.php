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
            $roles = Role::pluck('id', 'name')->toArray();
            Config::set('role', $roles);
        } catch (\Exception $e) {
            Config::set('role', []);
        }
    }

    public function initializeRolesConfig(){
        // for future uses.
    }

    public function fetchRoleIdByName($name)
    {
        try {
            $roleId = Role::where('name', $name)->value('id');
            return $roleId;
        } catch (\Exception $e) {
            return null;
        }
    }
}
