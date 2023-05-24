<?php

namespace App\Policies;

use App\Models\QC;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QCPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // return $user->hasAnyRole(['Creator_qcs', 'Admin', 'Editor']);
        $user->role->name == 'Creator_qcs' || $user->role->name == 'Admin' || $user->role->name == 'Editor';
        return $user->role->name == 'Creator_qcs' || $user->role->name == 'Admin' || $user->role->name == 'Editor';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\QC  $qC
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, QC $qC)
    {
        // return $user->hasAnyRole(['Creator_qcs', 'Admin', 'Editor']);
        $user->role->name == 'Creator_qcs' || $user->role->name == 'Admin' || $user->role->name == 'Editor';
        return $user->role->name == 'Creator_qcs' || $user->role->name == 'Admin' || $user->role->name == 'Editor';
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        // return $user->hasAnyRole(['Creator_qcs', 'Admin', 'Editor']);
        $user->role->name == 'Creator_qcs' || $user->role->name == 'Admin' || $user->role->name == 'Editor';
        return $user->role->name == 'Creator_qcs' || $user->role->name == 'Admin' || $user->role->name == 'Editor';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\QC  $qC
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, QC $qC)
    {
        // return $user->hasAnyRole(['Admin', 'Editor']);
        $user->role->name == 'Admin' || $user->role->name == 'Editor';
        return $user->role->name == 'Admin' || $user->role->name == 'Editor';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\QC  $qC
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, QC $qC)
    {
        // return $user->hasAnyRole(['Admin', 'Editor']);

        $user->role->name == 'Admin' || $user->role->name == 'Editor';
        return $user->role->name == 'Admin' || $user->role->name == 'Editor';
    }
}
