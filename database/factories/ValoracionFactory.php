<?php

namespace Database\Factories;

use App\Models\Valoracion;
use Illuminate\Database\Eloquent\Factories\Factory;

class ValoracionFactory extends Factory
{
    protected $model = Valoracion::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'cuerpo_valoracion' => $this->faker->paragraph,
            'puntuacion' => $this->faker->numberBetween(1, 5),
            'empresa_id' => \App\Models\Empresa::factory(),
            'cita_id' => \App\Models\Cita::factory(),
        ];
    }
}