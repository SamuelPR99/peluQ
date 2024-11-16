<?php

namespace Database\Factories;

use App\Models\Servicio;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServicioFactory extends Factory
{
    protected $model = Servicio::class;

    public function definition()
    {
        return [
            'empresa_id' => \App\Models\Empresa::factory(),
            'servicio' => $this->faker->randomElement(['Corte de pelo', 'Tinte', 'Barba']),
            'precio' => $this->faker->randomFloat(2, 5, 50),
        ];
    }
}