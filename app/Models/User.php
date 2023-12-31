<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'sexo',
        'ciudad',
        'pais',
        'nacimiento',
        'rol_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //Relación uno a muchos:

    public function criticas()
    {
        return $this->hasMany(Critica::class);
    }

    public function votaciones()
    {
        return $this->hasMany(Votacion::class);
    }

    //Relación uno a muchos (inversa):

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    //Relación muchos a muchos:

    //Seguidos (Follows) usuarios que son tus amigos
    public function users()
    {
        return $this->belongsToMany(User::class, 'amigos', 'user_id', 'amigo_id');
    }

    public function usuariosSeguimientos()
    {
        return $this->belongsToMany(Audiovisual::class, 'seguimientos');
    }

    // Edad del usuario logueado.
    public function getEdadAttribute()
    {
        return now()->year - $this->nacimiento;
    }
}
