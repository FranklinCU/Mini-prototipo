<?php

namespace App\Providers;

use App\Events\TaskCreated;
use App\Listeners\TaskCreatedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

// Proveedor que registra los listeners de eventos
class EventServiceProvider extends ServiceProvider
{
    // Lista de eventos y sus listeners
    protected $listen = [
        TaskCreated::class => [
            TaskCreatedListener::class,
        ],
    ];
}
