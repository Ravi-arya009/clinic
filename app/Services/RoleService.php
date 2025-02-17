<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
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
