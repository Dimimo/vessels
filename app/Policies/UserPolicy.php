<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
     * Determine whether the user can create users.
     *
     * @param  User $user
     * @return bool|null
     */
    public function create(User $user)
    {
        return $user->can('create users') ? true : null;
    }

    /**
     * Determine whether the user can update the users.
     *
     * @param  User $user
     * @param  User $personal
     * @return mixed
     */
    public function update(User $user, User $personal)
    {
        if ($user->can('edit own users')) {
            //port authority can edit everybody who has something to do with their port,
            // including other port authorities, operators, agents but NOT captains
            if ($user->is_port_authority) {
                $user->ports->contains($personal->ports) ? true : null;
            }
            //checks if the user is an operator
            if ($user->is_operator) {
                //an operator can edit another operator
                if ($personal->is_operator) {
                    $operators = $personal->operators;
                    $operators->pull($operators->first());
                    return $user->operators->contains($operators) ? true : null;
                }
                //an operator can edit one of it's own captains
                if ($personal->is_captain) {
                    return $user->operators->contains($personal->captain->operator) ? true : null;
                }
                //none is true, so deny entry
                return null;
            }
        }
        return $user->can('edit all users') ? true : null;
    }

    /**
     * Determine whether the user can delete the port.
     *
     * @param  User $user
     * @param  User $personal
     * @return mixed
     */
    public function delete(User $user, User $personal)
    {
        if ($user->can('delete own users')) {
            //port authority can edit everybody who has something to do with their port,
            // including other port authorities, operators, agents but NOT captains
            if ($user->is_port_authority) {
                $user->ports->contains($personal->ports) ? true : null;
            }
            //checks if the user is an operator
            if ($user->is_operator) {
                //an operator can edit another operator
                if ($personal->is_operator) {
                    $operators = $personal->operators;
                    $operators->pull($operators->first());
                    return $user->operators->contains($operators) ? true : null;
                }
                //an operator can edit one of it's own captains
                if ($personal->is_captain) {
                    return $user->operators->contains($personal->captain->operator) ? true : null;
                }
                //none is true, so deny entry
                return null;
            }
        }
        return $user->can('delete all users') ? true : null;
    }
}
