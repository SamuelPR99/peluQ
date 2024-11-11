<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cita;

class CitaSeeder extends Seeder
{
    public function run()
    {
        Cita::factory()->count(10)->create();
    }
}