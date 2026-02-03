<?php

namespace App\Providers;

use App\Models\Task;
use App\Policies\TaskPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

// Proveedor que registra las policies de autorizacion
class AuthServiceProvider extends ServiceProvider
{
    // Lista de modelos y sus policies
    protected $policies = [
        Task::class => TaskPolicy::class,
    ];

    // Registra las policies de la app
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
