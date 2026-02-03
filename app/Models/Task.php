<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

// Modelo Eloquent para la tabla tasks
class Task extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'done',
    ];

    protected $casts = [
        'done' => 'boolean',
    ];

    // Relacion con el usuario creador
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relacion con los logs de la tarea
    public function logs(): HasMany
    {
        return $this->hasMany(TaskLog::class);
    }
}
