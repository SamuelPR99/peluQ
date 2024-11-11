<?php

namespace Database\Factories;

use App\Models\Peluquero;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeluqueroFactory extends Factory
{
    protected $model = Peluquero::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'imagen' => $this->faker->imageUrl,
            'servicios' => $this->faker->sentence,
            'empresa_id' => \App\Models\Empresa::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}