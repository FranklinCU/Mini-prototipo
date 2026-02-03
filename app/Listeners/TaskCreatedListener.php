<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use App\Models\TaskLog;

// Listener que reacciona al evento TaskCreated
class TaskCreatedListener
{
    // Crea un log cuando se dispara el evento TaskCreated
    public function handle(TaskCreated $event): void
    {
        TaskLog::create([
            'task_id' => $event->task->id,
            'action' => 'created_event',
            'note' => 'listener',
        ]);
    }
}
