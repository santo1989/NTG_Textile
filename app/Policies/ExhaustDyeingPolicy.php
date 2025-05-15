<?php

namespace App\Policies;

use App\Models\ExhaustDyeing;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExhaustDyeingPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // return $user->hasAnyRole(['Creator_eds', 'Admin', 'Editor']);
        $user->role->name == 'Creator_eds' || $user->role->name == 'Admin' || $user->role->name == 'Editor';
        return $user->role->name == 'Creator_eds' || $user->role->name == 'Admin' || $user->role->name == 'Editor';
    }

    public function view(User $user, ExhaustDyeing $cpb)
    {
        // return $user->hasAnyRole(['Creator_eds', 'Admin', 'Editor']);
        $user->role->name == 'Creator_eds' || $user->role->name == 'Admin' || $user->role->name == 'Editor';
        return $user->role->name == 'Creator_eds' || $user->role->name == 'Admin' || $user->role->name == 'Editor';
    }

    public function create(User $user)
    {
        // return $user->hasAnyRole(['Creator_eds', 'Admin', 'Editor']);
        $user->role->name == 'Creator_eds' || $user->role->name == 'Admin' || $user->role->name == 'Editor';
        return $user->role->name == 'Creator_eds' || $user->role->name == 'Admin' || $user->role->name == 'Editor';
    }

    public function update(User $user, ExhaustDyeing $cpb)
    {
        // return $user->hasAnyRole(['Admin', 'Editor']);
        $user->role->name == 'Admin' || $user->role->name == 'Editor';
        return $user->role->name == 'Admin' || $user->role->name == 'Editor';
    }

    public function delete(User $user, ExhaustDyeing $cpb)
    {
        // return $user->hasAnyRole(['Admin', 'Editor']);

        $user->role->name == 'Admin' || $user->role->name == 'Editor';
        return $user->role->name == 'Admin' || $user->role->name == 'Editor';
    }
}
