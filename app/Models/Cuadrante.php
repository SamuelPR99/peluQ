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
    ];

    public function peluquero()
    {
        return $this->belongsTo(Peluquero::class);
    }
}
