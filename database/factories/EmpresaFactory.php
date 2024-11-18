<?php

namespace Database\Factories;

use App\Models\Empresa;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Services\GeocodingService;
use Faker\Factory as FakerFactory;

class EmpresaFactory extends Factory
{
    protected $model = Empresa::class;

    public function definition()
    {
        $faker = FakerFactory::create('es_ES'); // Configurar faker para español
        $calle = $faker->streetName;
        $ciudad = $faker->city;
        $direccion = $calle;
        $geocodingService = new GeocodingService();
        $coordenadas = $geocodingService->getCoordinatesFromAddress($direccion);

        return [
            'nombre_empresa' => $faker->randomElement(['Peluqueria', 'Barberia']) . ' ' . $ciudad,
            'email' => $faker->companyEmail,
            'telefono' => $faker->phoneNumber,
            'direccion' => $direccion,
            'codigo_postal' => $faker->postcode,
            'coordenadas' => $coordenadas,
            'estado_subscripcion' => $faker->randomElement(['activo', 'inactivo']),
            'user_id' => \App\Models\User::factory(),
            'tipo_empresa' => $faker->randomElement(['peluqueria', 'barberia', 'peluqueria y barberia']),
        ];
    }
}