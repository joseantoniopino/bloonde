<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;

class CustomerPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->profile->name === 'admin';
    }

    public function view(User $user, Customer $customer): bool
    {
        return $user->profile->name === 'admin' || $user->id === $customer->user_id;
    }

    public function create(User $user): bool
    {
        return $user->profile->name === 'admin';
    }

    public function update(User $user, Customer $customer): bool
    {
        return $user->profile->name === 'admin' || $user->id === $customer->user_id;
    }

    public function delete(User $user, Customer $customer): bool
    {
        return $user->profile->name === 'admin' || $user->id === $customer->user_id;
    }
}
