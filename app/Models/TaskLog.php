<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Modelo Eloquent para la tabla task_logs
class TaskLog extends Model
{
    protected $fillable = [
        'task_id',
        'action',
        'note',
    ];

    // Relacion con la tarea
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
