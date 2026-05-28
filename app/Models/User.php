<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['nombres', 'apellidos', 'fecha_nacimiento', 'email', 'password', 'rol', 'estado'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'fecha_nacimiento' => 'date',
        ];
    }
    protected static function booted(): void
    {
        //para crear un usuario: nos aseguramos que no sea root
        static::creating(function (User $user) {
            if ($user->rol === 'root') {
                $rootExists = User::where('rol', 'root')->exists();
                if ($rootExists) {
                    abort(403, 'Ya existe un usuario con rol root. No se puede crear otro.');
                }
            }
        });
        //para actualizar al usuario
        static::updating(function (User $user) {
            if ($user->getOriginal('rol') == 'root') {
                abort(403, 'No se puede modificar el rol de un usuario root.');
            }
            if ($user->isDirty('rol') && $user->rol === 'root') {
                $rootExists = User::where('rol', 'root')->exists();
                if ($rootExists) {
                    abort(403, 'Ya existe un usuario con rol root. No se puede asignar este rol a otro usuario.');
                }
            }
        });
        //para eliminar al usuario
        static::deleting(function (User $user) {
            if ($user->rol === 'root' || $user->getOriginal('rol') === 'root') {
                abort(403, 'No se puede eliminar un usuario con rol root.');
            }
        });
    }
}
