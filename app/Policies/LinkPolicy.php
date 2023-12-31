<?php

namespace App\Policies;

use App\Models\Link;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LinkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the link can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list links');
    }

    /**
     * Determine whether the link can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Link  $model
     * @return mixed
     */
    public function view(User $user, Link $model)
    {
        return $user->hasPermissionTo('view links');
    }

    /**
     * Determine whether the link can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create links');
    }

    /**
     * Determine whether the link can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Link  $model
     * @return mixed
     */
    public function update(User $user, Link $model)
    {
        return $user->hasPermissionTo('update links');
    }

    /**
     * Determine whether the link can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Link  $model
     * @return mixed
     */
    public function delete(User $user, Link $model)
    {
        return $user->hasPermissionTo('delete links');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Link  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete links');
    }

    /**
     * Determine whether the link can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Link  $model
     * @return mixed
     */
    public function restore(User $user, Link $model)
    {
        return false;
    }

    /**
     * Determine whether the link can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Link  $model
     * @return mixed
     */
    public function forceDelete(User $user, Link $model)
    {
        return false;
    }
}
