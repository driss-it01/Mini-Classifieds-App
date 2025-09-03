<?php

namespace App\Policies;

use App\Models\Ad;
use App\Models\User;

class AdPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Ad $ad): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user !== null;
    }

    public function update(User $user, Ad $ad): bool
    {
        return $user->id === $ad->user_id;
    }

    public function delete(User $user, Ad $ad): bool
    {
        return $user->id === $ad->user_id;
    }

    public function restore(User $user, Ad $ad): bool
    {
        return false;
    }

    public function forceDelete(User $user, Ad $ad): bool
    {
        return false;
    }
}
