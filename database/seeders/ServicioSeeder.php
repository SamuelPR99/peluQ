<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servicio;
use App\Models\Empresa;

class ServicioSeeder extends Seeder
{
    public function run()
    {
        $empresas = Empresa::all();

        foreach ($empresas as $empresa) {
            Servicio::create([
                'empresa_id' => $empresa->id,
                'servicio' => 'Corte de pelo',
                'precio' => 15.00,
            ]);

            Servicio::create([
                'empresa_id' => $empresa->id,
                'servicio' => 'Tinte',
                'precio' => 30.00,
            ]);

            Servicio::create([
                'empresa_id' => $empresa->id,
                'servicio' => 'Barba',
                'precio' => 5.00,
            ]);

        }
    }
}