<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cuadrante;

class CuadranteSeeder extends Seeder
{
    public function run()
    {
        Cuadrante::factory()->count(10)->create();
    }
}