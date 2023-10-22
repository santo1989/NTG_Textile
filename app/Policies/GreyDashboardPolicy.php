<?php

namespace App\Policies;

use App\Models\GreyDashboard;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GreyDashboardPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // return $user->hasAnyRole(['Creator_grey', 'Admin', 'Editor_fabrics']);
        $user->role->name == 'Creator_grey' || $user->role->name == 'Admin' || $user->role->name == 'Editor_fabrics';
        return $user->role->name == 'Creator_grey' || $user->role->name == 'Admin' || $user->role->name == 'Editor_fabrics';
    }

    public function view(User $user, GreyDashboard $yarn)
    {
        // return $user->hasAnyRole(['Creator_grey', 'Admin', 'Editor_fabrics']);
        $user->role->name == 'Creator_grey' || $user->role->name == 'Admin' || $user->role->name == 'Editor_fabrics';
        return $user->role->name == 'Creator_grey' || $user->role->name == 'Admin' || $user->role->name == 'Editor_fabrics';
    }

    public function create(User $user)
    {
        // return $user->hasAnyRole(['Creator_grey', 'Admin', 'Editor_fabrics']);
        $user->role->name == 'Creator_grey' || $user->role->name == 'Admin' || $user->role->name == 'Editor_fabrics';
        return $user->role->name == 'Creator_grey' || $user->role->name == 'Admin' || $user->role->name == 'Editor_fabrics';
    }

    public function update(User $user, GreyDashboard $yarn)
    {
        // return $user->hasAnyRole(['Admin', 'Editor_fabrics']);
        $user->role->name == 'Admin' || $user->role->name == 'Editor_fabrics';
        return $user->role->name == 'Admin' || $user->role->name == 'Editor_fabrics';
    }

    public function delete(User $user, GreyDashboard $yarn)
    {
        // return $user->hasAnyRole(['Admin', 'Editor_fabrics']);

        $user->role->name == 'Admin' || $user->role->name == 'Editor_fabrics';
        return $user->role->name == 'Admin' || $user->role->name == 'Editor_fabrics';
    }
}
