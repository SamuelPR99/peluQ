<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuadrante extends Model
{
    use HasFactory;

    protected $fillable
    = [
        'peluquero_id',
        'fecha',
        'hora_entrada',
        'hora_salida',
        'servicio_id',
    ];

    public function peluquero()
    {
        return $this->belongsTo(Peluquero::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}
