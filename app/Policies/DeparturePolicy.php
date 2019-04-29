<?php

namespace App\Policies;

use App\Departure;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class DeparturePolicy
 * @package App\Policies
 */
class DeparturePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the official info on the departure.
     *
     * @param User $user
     * @return bool|null
     */
    public function official(User $user)
    {
        return $user->can('official info') ? true : null;
    }

    /**
     * Determine whether the user can create departures.
     *
     * @param  User $user
     * @return bool|null
     */
    public function create(User $user)
    {
        return $user->can('create departures') ? true : null;
    }

    /**
     * Determine whether the user can update the departure.
     *
     * @param  User      $user
     * @param  Departure $departure
     * @return mixed
     */
    public function update(User $user, Departure $departure)
    {
        if ($user->can('edit own departures')) {
            return $user->operators->contains($departure->vessel->operator_id) ? true : null;
        }
        return $user->can('edit all departures') ? true : null;
    }

    /**
     * Determine whether the user can delete the departure.
     *
     * @param  User      $user
     * @param  Departure $departure
     * @return mixed
     */
    public function delete(User $user, Departure $departure)
    {
        if ($user->can('delete own departures')) {
            return $user->operators->contains($departure->vessel->operator_id) ? true : null;
        }
        return $user->can('delete all departures') ? true : null;
    }

    /**
     * Determine whether the user can update the departure.
     *
     * @param  User      $user
     * @param  Departure $departure
     * @return mixed
     */
    public function real_departure(User $user, Departure $departure)
    {
        if ($user->can('real own departures')) {
            if ($user->is_captain) {
                return $user->captain->id === $departure->captain_id ? true : null;
            }
            if ($user->is_agent) {
                return $user->ports->contains($departure->from_port_id) ? true : null;
            }
        }

        return $user->can('real all departures') ? true : null;
    }
}
