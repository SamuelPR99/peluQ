<?php

namespace Database\Factories;

use App\Models\Cita;
use Illuminate\Database\Eloquent\Factories\Factory;

class CitaFactory extends Factory
{
    protected $model = Cita::class;

    public function definition()
    {
        return [
            'fecha_cita' => $this->faker->date,
            'hora_cita' => $this->faker->time,
            'observaciones' => $this->faker->sentence,
            'user_id' => \App\Models\User::factory(),
            'peluquero_id' => \App\Models\Peluquero::factory(),
            'empresa_id' => \App\Models\Empresa::factory(),
            'servicio_id' => \App\Models\Servicio::factory(),
            'estado_cita' => $this->faker->randomElement(['pendiente', 'confirmada', 'anulada', 'expirada']),
        ];
    }
}