<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_cita',
        'hora_cita',
        'observaciones',
        'tipo_cita',
        'estado_cita',
        'user_id',
        'peluquero_id',
        'empresa_id',
        'servicio_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function peluquero()
    {
        return $this->belongsTo(Peluquero::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}