<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Modelo Eloquent para la tabla users
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    // Campos ocultos en serializacion
    protected $hidden = [
        'password',
    ];

    // Casts de atributos
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
