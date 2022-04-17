<?php

use App\Models\Role;
use App\Models\User;

if (!function_exists('is_admin')) {
    function is_admin (?User $user): bool
    {
        return $user && ($user->role_id === Role::getAdminRole()->id);
    }
}
