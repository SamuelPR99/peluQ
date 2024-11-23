<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Services\GeocodingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Providers\AuthServiceProvider;
class EmpresasController extends Controller
{
    use AuthorizesRequests;
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
        $this->authorize('create', Empresa::class);
        return view('empresas.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Empresa::class);

        $request->validate([
            'nombre_empresa' => 'required',
            'email' => 'required|email',
            'telefono' => 'required|digits:9',
            'direccion' => 'required',
            'codigo_postal' => 'required',
            'confirmar_subscripcion' => 'required',
            'tipo_empresa' => 'required|in:peluqueria,barberia,peluqueria y barberia',
        ], [
            'nombre_empresa.required' => 'El nombre de la empresa es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'telefono.digits' => 'El teléfono debe tener 9 dígitos.',
            'telefono.request' => 'Debe introducir un número de teléfono.',
            'direccion.required' => 'La dirección es obligatoria.',
        ]);

        $coordenadas = $this->geocodingService->getCoordinatesFromAddress($request->direccion . ', ' . $request->codigo_postal);

        try {
            $empresa = Empresa::create([
                'nombre_empresa' => $request->nombre_empresa,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'codigo_postal' => $request->codigo_postal,
                'estado_subscripcion' => $request->confirmar_subscripcion ? 'activo' : 'inactivo',
                'coordenadas' => $coordenadas,
                'user_id' => Auth::id(),
                'tipo_empresa' => $request->tipo_empresa,
            ]);

            foreach ($request->servicios ?? [] as $servicio) {
                $empresa->servicios()->create($servicio);
            }

            DB::statement('CALL update_user_type(?)', [Auth::id()]);

            Log::info('Empresa creada exitosamente:', ['empresa_id' => $empresa->id]);

            return redirect()->route('empresas.peluqueros.index', ['empresa' => $empresa->id]);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function show(Empresa $empresa)
    {
        $this->authorize('view', $empresa);
        return view('empresas.show', compact('empresa'));
    }

    public function edit(Empresa $empresa)
    {
        $this->authorize('update', $empresa);
        return view('empresas.edit', compact('empresa'));
    }

    public function update(Request $request, Empresa $empresa)
    {
        $this->authorize('update', $empresa);

        $request->validate([
            'nombre_empresa' => 'required',
            'email' => 'required|email',
            'telefono' => 'required|digits:9', // Añadir validación de 9 dígitos
            'direccion' => 'required',
            'codigo_postal' => 'required',
            'estado_subscripcion' => $request->confirmar_subscripcion ? 'activo' : 'inactivo',
            'tipo_empresa' => 'required|in:peluqueria,barberia,peluqueria y barberia',
        ], [
            'nombre_empresa.required' => 'Nombre de empresa obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'telefono.digits' => 'El teléfono debe tener 9 dígitos.',
            'telefono.required' => 'Debe introducir un número de teléfono.',
            'direccion.required' => 'Campo obligatorio.',
        ]);

        $coordenadas = $this->geocodingService->getCoordinatesFromAddress($request->direccion . ', ' . $request->codigo_postal);

        $empresa->update([
            'nombre_empresa' => $request->nombre_empresa,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'codigo_postal' => $request->codigo_postal,
            'estado_subscripcion' => $request->confirmar_subscripcion ? 'activo' : 'inactivo',
            'coordenadas' => $coordenadas,
            'tipo_empresa' => $request->tipo_empresa,
        ]);

        $empresa->servicios()->delete();
        foreach ($request->servicios ?? [] as $servicio) {
            $empresa->servicios()->create($servicio);
        }

        return redirect()->route('dashboard');
    }

    public function destroy(Empresa $empresa)
    {
        $this->authorize('delete', $empresa);
        $empresa->delete();
        return redirect()->route('dashboard');
    }
}