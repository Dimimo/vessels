<?php

namespace App\Policies;

use App\Operator;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class OperatorPolicy
 * @package App\Policies
 */
class OperatorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the official info on the operator.
     *
     * @param User $user
     * @return bool|null
     */
    public function official(User $user)
    {
        return $user->can('official info') ? true : null;
    }

    /**
     * Determine whether the user can create operator.
     *
     * @param  User $user
     * @return bool|null
     */
    public function create(User $user)
    {
        return $user->can('create operators') ? true : null;
    }

    /**
     * Determine whether the user can update the operator.
     *
     * @param  User     $user
     * @param  Operator $operator
     * @return mixed
     */
    public function update(User $user, Operator $operator)
    {
        if ($user->can('edit own operators')) {
            return $operator->admins->contains($user->id) ? true : null;
        }
        return $user->can('edit all operators') ? true : null;
    }

    /**
     * Determine whether the user can delete the operator.
     *
     * @param  User     $user
     * @param  Operator $operator
     * @return mixed
     */
    public function delete(User $user, Operator $operator)
    {
        if ($user->can('delete own operators')) {
            return $operator->admins->contains($user->id) ? true : null;
        }
        return $user->can('delete all operators') ? true : null;
    }
}
