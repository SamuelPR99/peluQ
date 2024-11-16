<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_empresa', 
        'email',
        'telefono',
        'direccion',
        'codigo_postal',
        'coordenadas',
        'estado_subscripcion',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function peluqueros()
    {
        return $this->hasMany(Peluquero::class);
    }

    public function valoracion()
    {
        return $this->hasMany(Valoracion::class);
    }

    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }
}