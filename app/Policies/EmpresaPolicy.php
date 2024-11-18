<?php

namespace App\Policies;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmpresaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the empresa.
     */
    public function view(User $user, Empresa $empresa)
    {
        return $user->id === $empresa->user_id;
    }

    /**
     * Determine whether the user can update the empresa.
     */
    public function update(User $user, Empresa $empresa)
    {
        return $user->id === $empresa->user_id;
    }

    /**
     * Determine whether the user can delete the empresa.
     */
    public function delete(User $user, Empresa $empresa)
    {
        return $user->id === $empresa->user_id;
    }

    /**
     * Determine whether the user can create a new empresa.
     */
    public function create(User $user)
    {
        return $user->empresas->isEmpty();
    }

    // Puedes agregar más métodos según sea necesario (delete, create, etc.)
}