<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\Empresa;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    public function index(Empresa $empresa)
    {
        $servicios = $empresa->servicios;
        return view('servicios.index', compact('servicios', 'empresa'));
    }

    public function create(Empresa $empresa)
    {
        return view('servicios.create', compact('empresa'));
    }

    public function store(Request $request, Empresa $empresa)
    {
        $request->validate([
            'servicio' => 'required',
            'precio' => 'required|numeric',
        ]);

        $empresa->servicios()->create($request->all());

        return redirect()->route('empresas.servicios.index', $empresa);
    }

    public function edit(Empresa $empresa, Servicio $servicio)
    {
        return view('servicios.edit', compact('empresa', 'servicio'));
    }

    public function update(Request $request, Empresa $empresa, Servicio $servicio)
    {
        $request->validate([
            'servicio' => 'required',
            'precio' => 'required|numeric',
        ]);

        $servicio->update($request->all());

        return redirect()->route('empresas.servicios.index', $empresa);
    }

    public function destroy(Empresa $empresa, Servicio $servicio)
    {
        $servicio->delete();
        return redirect()->route('empresas.servicios.index', $empresa);
    }
}