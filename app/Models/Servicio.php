<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'servicio',
        'precio',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function canBeDeleted()
    {
        return $this->citas()->count() === 0;
    }
}