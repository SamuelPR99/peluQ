<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Services\GeocodingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmpresasController extends Controller
{
    protected $geocodingService;

    public function __construct(GeocodingService $geocodingService)
    {
        $this->geocodingService = $geocodingService;
    }

    public function index()
    {
        $empresas = Empresa::all();
        return view('empresas.index', compact('empresas'));
    }

    public function create()
    {
        return view('empresas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_empresa' => 'required',
            'email' => 'required|email',
            'telefono' => 'required',
            'direccion' => 'required',
            'codigo_postal' => 'required',
            'confirmar_subscripcion' => 'required',
        ]);

        $coordenadas = $this->geocodingService->getCoordinatesFromAddress($request->direccion . ', ' . $request->codigo_postal);

        $empresa = Empresa::create([
            'nombre_empresa' => $request->nombre_empresa,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'codigo_postal' => $request->codigo_postal,
            'estado_subscripcion' => $request->confirmar_subscripcion ? 'activo' : 'inactivo', // Asegúrate de manejar este campo correctamente
            'coordenadas' => $coordenadas,
            'user_id' => Auth::id(),
        ]);

        DB::statement('CALL update_user_type(?)', [Auth::id()]);

        return redirect()->route('empresas.peluqueros.index', ['empresa' => $empresa->id]);
    }

    public function show(Empresa $empresa)
    {
        return view('empresas.show', compact('empresa'));
    }

    public function edit(Empresa $empresa)
    {
        return view('empresas.edit', compact('empresa'));
    }

    public function update(Request $request, Empresa $empresa)
    {
        $request->validate([
            'nombre_empresa' => 'required',
            'email' => 'required|email',
            'telefono' => 'required',
            'direccion' => 'required',
            'codigo_postal' => 'required',
            'estado_subscripcion' => 'required',
        ]);

        $coordenadas = $this->geocodingService->getCoordinatesFromAddress($request->direccion . ', '. $request->codigo_postal);

        $empresa->update([
            'nombre_empresa' => $request->nombre_empresa,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'codigo_postal' => $request->codigo_postal,
            'estado_subscripcion' => $request->estado_subscripcion,
            'coordenadas' => $coordenadas,
            'user_id' => Auth::id(), 
        ]);

        return redirect()->route('empresas.index');
    }

    public function destroy(Empresa $empresa)
    {
        $empresa->delete();
        return redirect()->route('empresas.index');
    }
}