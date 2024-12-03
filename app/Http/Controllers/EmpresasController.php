<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Peluquero;
use App\Models\User;
use App\Services\GeocodingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

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
            'servicios' => 'required|array',
            'servicios.*.servicio' => 'required|string',
            'servicios.*.precio' => 'required|numeric',
        ], [
            'nombre_empresa.required' => 'El nombre de la empresa es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'telefono.digits' => 'El teléfono debe tener 9 dígitos.',
            'telefono.request' => 'Debe introducir un número de teléfono.',
            'direccion.required' => 'La dirección es obligatoria.',
            'servicios.required' => 'Debe proporcionar al menos un servicio.',
            'servicios.*.servicio.required' => 'El nombre del servicio es obligatorio.',
            'servicios.*.precio.required' => 'El precio del servicio es obligatorio.',
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

            foreach ($request->servicios as $servicio) {
                $empresa->servicios()->create($servicio);
            }

            User::where('id', Auth::id())->update(['user_type' => 'empresario']);
            Log::info('Empresa creada exitosamente:', ['empresa_id' => $empresa->id]);

            return redirect()->route('empresas.peluqueros.index', ['empresa' => $empresa->id]);
        } catch (\Exception $e) {
            Log::error('Error al crear la empresa:', ['error' => $e->getMessage()]);
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
            'telefono' => 'required|digits:9',
            'direccion' => 'required',
            'codigo_postal' => 'required',
            'estado_subscripcion' => $request->confirmar_subscripcion ? 'activo' : 'inactivo',
            'tipo_empresa' => 'required|in:peluqueria,barberia,peluqueria y barberia',
            'servicios' => 'required|array',
            'servicios.*.servicio' => 'required|string',
            'servicios.*.precio' => 'required|numeric',
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

        $existingServicios = $empresa->servicios->keyBy('id');
        $inputServicios = collect($request->servicios);
        $processedIds = [];

        foreach ($inputServicios as $inputServicio) {
            if (!empty($inputServicio['id']) && $existingServicios->has($inputServicio['id'])) {
                $servicio = $existingServicios[$inputServicio['id']];
                $servicio->update([
                    'servicio' => $inputServicio['servicio'],
                    'precio' => $inputServicio['precio'],
                ]);
                $servicio->citas()->update(['servicio_id' => $servicio->id]);
                $processedIds[] = $servicio->id;
            } else {
                $newServicio = $empresa->servicios()->create([
                    'servicio' => $inputServicio['servicio'],
                    'precio' => $inputServicio['precio'],
                ]);
                $processedIds[] = $newServicio->id;
            }
        }

        $toDelete = $existingServicios->keys()->diff($processedIds);
        foreach ($toDelete as $id) {
            $servicio = $existingServicios[$id];
            if ($servicio->canBeDeleted()) {
                $servicio->delete();
            } else {
                return response()->json(['message' => 'No se puede eliminar el servicio porque tiene citas confirmadas.'], 400);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Empresa actualizada correctamente.');
    }

    public function destroy(Empresa $empresa)
    {
        $this->authorize('delete', $empresa);

        // Eliminar usuarios de tipo peluquero que esten relacionados con la empresa
        $peluqueros = Peluquero::where('empresa_id', $empresa->id)->get();
        foreach ($peluqueros as $peluquero) {
            User::where('id', $peluquero->user_id)->where('user_type', 'peluquero')->delete();
            $peluquero->delete();
        }

        $empresa->delete();
        
        // Cambiar el tipo de usuario a 'user'
        User::where('id', Auth::id())->update(['user_type' => 'user']);

        return redirect()->route('dashboard');
    }
}
