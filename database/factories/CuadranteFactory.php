<?php

namespace Database\Factories;

use App\Models\Cuadrante;
use Illuminate\Database\Eloquent\Factories\Factory;

class CuadranteFactory extends Factory
{
    protected $model = Cuadrante::class;

    public function definition()
    {
        return [
            'peluquero_id' => \App\Models\Peluquero::factory(),
            'fecha' => $this->faker->date,
            'hora_entrada' => $this->faker->time,
            'hora_salida' => $this->faker->time,
            'servicio_id' => \App\Models\Servicio::factory(),
        ];
    }
}