<?php

namespace App\Policies;

use App\Port;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class PortPolicy
 * @package App\Policies
 */
class PortPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the official info on the port.
     *
     * @param User $user
     * @return bool|null
     */
    public function official(User $user)
    {
        return $user->can('official info') ? true : null;
    }

    /**
     * Determine whether the user can create ports.
     *
     * @param  User $user
     * @return bool|null
     */
    public function create(User $user)
    {
        return $user->can('create ports') ? true : null;
    }

    /**
     * Determine whether the user can update the port.
     *
     * @param  User $user
     * @param  Port $port
     * @return mixed
     */
    public function update(User $user, Port $port)
    {
        if ($user->can('edit own ports')) {
            return $port->admins->contains($user->id) ? true : null;
        }
        return $user->can('edit all ports') ? true : null;
    }

    /**
     * Determine whether the user can delete the port.
     *
     * @param  User $user
     * @param  Port $port
     * @return mixed
     */
    public function delete(User $user, Port $port)
    {
        if ($user->can('delete own ports')) {
            return $port->admins->contains($user->id) ? true : null;
        }
        return $user->can('delete all ports') ? true : null;
    }
}
