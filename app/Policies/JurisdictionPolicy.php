<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Jurisdiction;
use App\Models\User;

class JurisdictionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role !== UserRole::Client;
    }

    public function view(User $user, Jurisdiction $jurisdiction): bool
    {
        return $this->viewAny($user);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::Admin,
            UserRole::Manager,
            UserRole::Demo,
        ], true);
    }

    public function update(User $user, Jurisdiction $jurisdiction): bool
    {
        return $this->create($user);
    }

    public function delete(User $user, Jurisdiction $jurisdiction): bool
    {
        return in_array($user->role, [UserRole::SuperAdmin, UserRole::Admin], true);
    }
}
