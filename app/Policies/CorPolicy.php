<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Cor;
use Illuminate\Auth\Access\HandlesAuthorization;

class CorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_cor');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cor  $cor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Cor $cor): bool
    {
        return $user->can('view_cor');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_cor');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cor  $cor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Cor $cor): bool
    {
        return $user->can('update_cor');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cor  $cor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Cor $cor): bool
    {
        return $user->can('delete_cor');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_cor');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cor  $cor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Cor $cor): bool
    {
        return $user->can('force_delete_cor');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_cor');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cor  $cor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Cor $cor): bool
    {
        return $user->can('restore_cor');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_cor');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cor  $cor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(User $user, Cor $cor): bool
    {
        return $user->can('replicate_cor');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_cor');
    }

}
