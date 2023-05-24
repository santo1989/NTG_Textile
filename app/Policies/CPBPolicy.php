<?php

namespace App\Policies;

use App\Models\CPB;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CPBPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // return $user->hasAnyRole(['Creator_cpbs', 'Admin', 'Editor']);
        $user->role->name == 'Creator_cpbs' || $user->role->name == 'Admin' || $user->role->name == 'Editor';
        return $user->role->name == 'Creator_cpbs' || $user->role->name == 'Admin' || $user->role->name == 'Editor';
    }

    public function view(User $user, CPB $cpb)
    {
        // return $user->hasAnyRole(['Creator_cpbs', 'Admin', 'Editor']);
        $user->role->name == 'Creator_cpbs' || $user->role->name == 'Admin' || $user->role->name == 'Editor';
        return $user->role->name == 'Creator_cpbs' || $user->role->name == 'Admin' || $user->role->name == 'Editor';
    }

    public function create(User $user)
    {
        // return $user->hasAnyRole(['Creator_cpbs', 'Admin', 'Editor']);
        $user->role->name == 'Creator_cpbs' || $user->role->name == 'Admin' || $user->role->name == 'Editor';
        return $user->role->name == 'Creator_cpbs' || $user->role->name == 'Admin' || $user->role->name == 'Editor';
    }

    public function update(User $user, CPB $cpb)
    {
        // return $user->hasAnyRole(['Admin', 'Editor']);
        $user->role->name == 'Admin' || $user->role->name == 'Editor';
        return $user->role->name == 'Admin' || $user->role->name == 'Editor';
    }

    public function delete(User $user, CPB $cpb)
    {
        // return $user->hasAnyRole(['Admin', 'Editor']);

        $user->role->name == 'Admin' || $user->role->name == 'Editor';
        return $user->role->name == 'Admin' || $user->role->name == 'Editor';
    }
}
