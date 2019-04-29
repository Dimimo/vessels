<?php

namespace App\Policies;

use App\User;
use App\Vessel;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class VesselPolicy
 * @package App\Policies
 */
class VesselPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the official info on the vessel.
     *
     * @param User $user
     * @return bool|null
     */
    public function official(User $user)
    {
        return $user->can('official info') ? true : null;
    }

    /**
     * Determine whether the user can create vessels.
     *
     * @param  User $user
     * @return bool|null
     */
    public function create(User $user)
    {
        return $user->can('create vessels') ? true : null;
    }

    /**
     * Determine whether the user can update the vessel.
     *
     * @param  User   $user
     * @param  vessel $vessel
     * @return mixed
     */
    public function update(User $user, vessel $vessel)
    {
        if ($user->can('edit own vessels')) {
            return $user->operators->contains($vessel->operator_id) ? true : null;
        }
        return $user->can('edit all vessels') ? true : null;
    }

    /**
     * Determine whether the user can delete the vessel.
     *
     * @param  User   $user
     * @param  vessel $vessel
     * @return mixed
     */
    public function delete(User $user, vessel $vessel)
    {
        if ($user->can('delete own vessels')) {
            return $user->operators->contains($vessel->operator_id) ? true : null;
        }
        return $user->can('delete all vessels') ? true : null;
    }
}
