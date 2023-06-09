<?php

namespace App\Policies;

use App\Models\Livraison;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LivraisonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Livraison  $livraison
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Livraison $livraison)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Livraison  $livraison
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Livraison $livraison)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Livraison  $livraison
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Livraison $livraison)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Livraison  $livraison
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Livraison $livraison)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Livraison  $livraison
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Livraison $livraison)
    {
        //
    }
}
