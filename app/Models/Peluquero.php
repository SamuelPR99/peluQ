<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peluquero extends Model
{
    use HasFactory;

    public $timestamps = false; // Desactivar timestamps

    protected $fillable = [
        'nombre',
        'imagen',
        'servicios',
        'empresa_id',
        'user_id',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function cuadrantes()
    {
        return $this->hasMany(Cuadrante::class);
    }
}