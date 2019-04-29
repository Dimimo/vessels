<?php

namespace App\Policies;

use App\Captain;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CaptainPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the official info on the captain.
     *
     * @param User $user
     * @return bool|null
     */
    public function official(User $user)
    {
        return $user->can('official info') ? true : null;
    }

    /**
     * Determine whether the user can create captains.
     *
     * @param  User $user
     * @return bool|null
     */
    public function create(User $user)
    {
        return $user->can('create captains') ? true : null;
    }

    /**
     * Determine whether the user can update the captain.
     *
     * @param  User    $user
     * @param  Captain $captain
     * @return mixed
     */
    public function update(User $user, Captain $captain)
    {
        if ($user->can('edit own captains')) {
            return $user->operators->contains($captain->operator_id) ? true : null;
        }
        return $user->can('edit all captains') ? true : null;
    }

    /**
     * Determine whether the user can delete the captain.
     *
     * @param  User    $user
     * @param  Captain $captain
     * @return mixed
     */
    public function delete(User $user, Captain $captain)
    {
        if ($user->can('delete own captains')) {
            return $user->operators->contains($captain->operator_id) ? true : null;
        }
        return $user->can('delete all captains') ? true : null;
    }
}
