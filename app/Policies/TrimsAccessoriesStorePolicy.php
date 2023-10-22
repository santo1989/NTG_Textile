<?php

namespace App\Policies;

use App\Models\TrimsAccessoriesStore;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrimsAccessoriesStorePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // return $user->hasAnyRole(['Creator_trim', 'Admin', 'Editor_garments']);
        $user->role->name == 'Creator_trim' || $user->role->name == 'Admin' || $user->role->name == 'Editor_garments';
        return $user->role->name == 'Creator_trim' || $user->role->name == 'Admin' || $user->role->name == 'Editor_garments';
    }

    public function view(User $user, TrimsAccessoriesStore $trim)
    {
        // return $user->hasAnyRole(['Creator_trim', 'Admin', 'Editor_garments']);
        $user->role->name == 'Creator_trim' || $user->role->name == 'Admin' || $user->role->name == 'Editor_garments';
        return $user->role->name == 'Creator_trim' || $user->role->name == 'Admin' || $user->role->name == 'Editor_garments';
    }

    public function create(User $user)
    {
        // return $user->hasAnyRole(['Creator_trim', 'Admin', 'Editor_garments']);
        $user->role->name == 'Creator_trim' || $user->role->name == 'Admin' || $user->role->name == 'Editor_garments';
        return $user->role->name == 'Creator_trim' || $user->role->name == 'Admin' || $user->role->name == 'Editor_garments';
    }

    public function update(User $user, TrimsAccessoriesStore $trim)
    {
        // return $user->hasAnyRole(['Admin', 'Editor_garments']);
        $user->role->name == 'Admin' || $user->role->name == 'Editor_garments';
        return $user->role->name == 'Admin' || $user->role->name == 'Editor_garments';
    }

    public function delete(User $user, TrimsAccessoriesStore $trim)
    {
        // return $user->hasAnyRole(['Admin', 'Editor_garments']);

        $user->role->name == 'Admin' || $user->role->name == 'Editor_garments';
        return $user->role->name == 'Admin' || $user->role->name == 'Editor_garments';
    }
}
