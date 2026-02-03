<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    // Permite ver cualquier tarea
    public function view(?User $user, Task $task): bool
    {
        return true;
    }

    // Permite actualizar si es autor o admin
    public function update(?User $user, Task $task): bool
    {
        if (!$user) return false;
        return $user->id === $task->user_id || $user->role === 'admin';
    }

    // Permite eliminar si es autor o admin
    public function delete(?User $user, Task $task): bool
    {
        if (!$user) return false;
        return $user->id === $task->user_id || $user->role === 'admin';
    }

    // Permite crear si esta autenticado
    public function create(?User $user): bool
    {
        return (bool) $user;
    }
}
