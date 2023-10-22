<?php

namespace App\Policies;

use App\Models\FabricInformationBoard;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FabricInformationBoardPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // return $user->hasAnyRole(['Creator_fabrics', 'Admin', 'Editor_garments']);
        $user->role->name == 'Creator_fabrics' || $user->role->name == 'Admin' || $user->role->name == 'Editor_garments';
        return $user->role->name == 'Creator_fabrics' || $user->role->name == 'Admin' || $user->role->name == 'Editor_garments';
    }

    public function view(User $user, FabricInformationBoard $fabrics)
    {
        // return $user->hasAnyRole(['Creator_fabrics', 'Admin', 'Editor_garments']);
        $user->role->name == 'Creator_fabrics' || $user->role->name == 'Admin' || $user->role->name == 'Editor_garments';
        return $user->role->name == 'Creator_fabrics' || $user->role->name == 'Admin' || $user->role->name == 'Editor_garments';
    }

    public function create(User $user)
    {
        // return $user->hasAnyRole(['Creator_fabrics', 'Admin', 'Editor_garments']);
        $user->role->name == 'Creator_fabrics' || $user->role->name == 'Admin' || $user->role->name == 'Editor_garments';
        return $user->role->name == 'Creator_fabrics' || $user->role->name == 'Admin' || $user->role->name == 'Editor_garments';
    }

    public function update(User $user, FabricInformationBoard $fabrics)
    {
        // return $user->hasAnyRole(['Admin', 'Editor_garments']);
        $user->role->name == 'Admin' || $user->role->name == 'Editor_garments';
        return $user->role->name == 'Admin' || $user->role->name == 'Editor_garments';
    }

    public function delete(User $user, FabricInformationBoard $fabrics)
    {
        // return $user->hasAnyRole(['Admin', 'Editor_garments']);

        $user->role->name == 'Admin' || $user->role->name == 'Editor_garments';
        return $user->role->name == 'Admin' || $user->role->name == 'Editor_garments';
    }
}
