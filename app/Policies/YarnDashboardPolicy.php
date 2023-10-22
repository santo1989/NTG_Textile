<?php

namespace App\Policies;

use App\Models\YarnDashboard;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class YarnDashboardPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // return $user->hasAnyRole(['Creator_yarn', 'Admin', 'Editor_fabrics']);
        $user->role->name == 'Creator_yarn' || $user->role->name == 'Admin' || $user->role->name == 'Editor_fabrics';
        return $user->role->name == 'Creator_yarn' || $user->role->name == 'Admin' || $user->role->name == 'Editor_fabrics';
    }

    public function view(User $user, YarnDashboard $yarn)
    {
        // return $user->hasAnyRole(['Creator_yarn', 'Admin', 'Editor_fabrics']);
        $user->role->name == 'Creator_yarn' || $user->role->name == 'Admin' || $user->role->name == 'Editor_fabrics';
        return $user->role->name == 'Creator_yarn' || $user->role->name == 'Admin' || $user->role->name == 'Editor_fabrics';
    }

    public function create(User $user)
    {
        // return $user->hasAnyRole(['Creator_yarn', 'Admin', 'Editor_fabrics']);
        $user->role->name == 'Creator_yarn' || $user->role->name == 'Admin' || $user->role->name == 'Editor_fabrics';
        return $user->role->name == 'Creator_yarn' || $user->role->name == 'Admin' || $user->role->name == 'Editor_fabrics';
    }

    public function update(User $user, YarnDashboard $yarn)
    {
        // return $user->hasAnyRole(['Admin', 'Editor_fabrics']);
        $user->role->name == 'Admin' || $user->role->name == 'Editor_fabrics';
        return $user->role->name == 'Admin' || $user->role->name == 'Editor_fabrics';
    }

    public function delete(User $user, YarnDashboard $yarn)
    {
        // return $user->hasAnyRole(['Admin', 'Editor_fabrics']);

        $user->role->name == 'Admin' || $user->role->name == 'Editor_fabrics';
        return $user->role->name == 'Admin' || $user->role->name == 'Editor_fabrics';
    }
}
