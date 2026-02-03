<?php

namespace App\Events;

use App\Models\Task;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

// Evento que representa la creacion de una tarea
class TaskCreated
{
    use Dispatchable, SerializesModels;

    // Recibe la tarea creada
    public function __construct(public Task $task)
    {
    }
}
