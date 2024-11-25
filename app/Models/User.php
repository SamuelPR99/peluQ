<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'username',
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
        'user_type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
     protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', 
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function citasAceptadas()
    {
        return $this->hasMany(Cita::class)->where('estado', 'aceptada');
    }

    public function citasPendientes()
    {
        return $this->hasMany(Cita::class)->where('estado', 'pendiente');
    }

    public function cuadrante()
    {
        return $this->hasOne(Cuadrante::class);
    }

    public function empresas()
    {
        return $this->hasMany(Empresa::class);
    }

    public function peluqueros()
    {
        return $this->hasMany(Peluquero::class);
    }

    public function valoracion()
    {
        return $this->hasMany(Valoracion::class);
    }

    public function peluquero()
    {
        return $this->hasOne(Peluquero::class);
    }
}
