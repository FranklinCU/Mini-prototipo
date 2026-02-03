<?php

namespace App\Services;

use App\Events\TaskCreated;
use App\Models\Task;
use App\Models\TaskLog;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TaskService
{
    // Crea una tarea y un log en transaccion, dispara evento
    public function create(?User $user, array $data): Task
    {
        $task = DB::transaction(function () use ($user, $data) {
            $task = Task::create([
                'user_id' => $user?->id,
                'title' => $data['title'],
                'body' => $data['body'] ?? null,
                'done' => $data['done'] ?? false,
            ]);

            TaskLog::create([
                'task_id' => $task->id,
                'action' => 'created',
                'note' => $user ? 'user:' . $user->id : null,
            ]);

            return $task;
        });

        event(new TaskCreated($task));

        return $task;
    }

    // Actualiza los datos de una tarea
    public function update(Task $task, array $data): Task
    {
        $task->fill([
            'title' => $data['title'],
            'body' => $data['body'] ?? null,
            'done' => $data['done'] ?? false,
        ]);

        $task->save();

        return $task;
    }
}
