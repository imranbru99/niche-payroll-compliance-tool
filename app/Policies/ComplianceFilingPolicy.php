<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\ComplianceFiling;
use App\Models\User;

class ComplianceFilingPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role !== UserRole::Client;
    }

    public function view(User $user, ComplianceFiling $filing): bool
    {
        if ($user->role === UserRole::Client) {
            return $filing->owner_id === $user->id;
        }

        return true;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::Admin,
            UserRole::Manager,
            UserRole::Staff,
            UserRole::Demo,
        ], true);
    }

    public function update(User $user, ComplianceFiling $filing): bool
    {
        return $this->create($user);
    }

    public function delete(User $user, ComplianceFiling $filing): bool
    {
        return in_array($user->role, [UserRole::SuperAdmin, UserRole::Admin, UserRole::Demo], true);
    }
}
