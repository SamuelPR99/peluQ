<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peluquero;

class PeluqueroSeeder extends Seeder
{
    public function run()
    {
        Peluquero::factory()->count(10)->create();
    }
}