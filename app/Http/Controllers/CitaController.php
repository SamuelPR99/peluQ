<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\CitaParaConfirmar;
use App\Mail\CitaConfirmada;
use App\Mail\CitaDenegada;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // index() es el método que muestra un listado de todas las citas
        $citas = Cita::all();
        return view('citas.index', compact('citas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // create() es el método que muestra el formulario de creación de una nueva cita
        $empresas = Empresa::where('estado_subscripcion', 'activo')->get();
        return view('citas.create', compact('empresas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Entrando al método store de CitaController');
        
        // Ajustar el formato de la hora
        $hora_cita = explode('+', $request->hora_cita)[0];
        $request->merge(['hora_cita' => $hora_cita]);

        Log::info('Datos recibidos para validar:', $request->all());

        $validatedData = $request->validate([
            'fecha_cita' => 'required|date',
            'hora_cita' => 'required|date_format:H:i:s',
            'observaciones' => 'nullable|string',
            'empresa_id' => 'required|exists:empresas,id',
            'peluquero_id' => 'required|exists:peluqueros,id',
            'estado_cita' => 'required|string',
            'servicio_id' => 'required|exists:servicios,id',
        ]);

        Log::info('Datos validados correctamente:', $validatedData);

        Log::info('Datos recibidos para crear cita:', [
            'fecha_cita' => $request->fecha_cita,
            'hora_cita' => $request->hora_cita,
            'observaciones' => $request->observaciones,
            'empresa_id' => $request->empresa_id,
            'peluquero_id' => $request->peluquero_id,
            'estado_cita' => $request->estado_cita,
            'servicio_id' => $request->servicio_id,
            'user_id' => Auth::id(),
        ]);

        try {
            $cita = Cita::create([
                'fecha_cita' => $request->fecha_cita,
                'hora_cita' => $request->hora_cita,
                'observaciones' => $request->observaciones,
                'estado_cita' => $request->estado_cita,
                'user_id' => Auth::id(),
                'peluquero_id' => $request->peluquero_id,
                'empresa_id' => $request->empresa_id,
                'servicio_id' => $request->servicio_id,
            ]);

            Log::info('Cita creada exitosamente:', ['cita_id' => $cita->id]);

            // Enviar correo electrónico al peluquero para confirmar la cita
            Mail::to($cita->peluquero->user->email)->send(new CitaParaConfirmar($cita));

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            Log::error('Error al crear la cita:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->withErrors('Error al crear la cita. Por favor, inténtelo de nuevo.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cita $cita)
    {
        // show() es el método que muestra los detalles de una cita en particular
        return view('citas.show', compact('cita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cita $cita)
    {
        // edit() es el método que muestra el formulario de edición de una cita en particular
        return view('citas.edit', compact('cita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cita $cita)
    {
        // update() es el método que se encarga de actualizar la cita en la base de datos
        $request->validate([
            'fecha_cita' => 'required|date',
            'hora_cita' => 'required|date_format:H:i',
            'observaciones' => 'nullable|string',
            'empresa_id' => 'required|exists:empresas,id',
            'peluquero_id' => 'required|exists:peluqueros,id',
            'estado_cita' => 'required|string',
            'servicio_id' => 'required|exists:servicios,id',
        ]);

        $cita->update($request->all());

        return redirect()->route('citas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cita $cita)
    {
        // destroy() es el método que se encarga de eliminar una cita de la base de datos
        $cita->delete();

        return redirect()->route('dashboard');
    }

    public function getCitas()
    {
        Log::info('Obteniendo todas las citas');

        $citas = Cita::all();
        $events = $citas->map(function ($cita) {
            return [
                'id' => $cita->id,
                'title' => $cita->user->name . ' - ' . $cita->servicio->nombre,
                'start' => $cita->fecha_cita->format('Y-m-d') . 'T' . $cita->hora_cita->format('H:i:s'),
                'end' => $cita->fecha_cita->format('Y-m-d') . 'T' . date('H:i:s', strtotime($cita->hora_cita) + 1800),
            ];
        });

        Log::info('Citas obtenidas: ' . $citas->count());
        Log::info('Eventos formateados: ' . $events->count());

        return response()->json($events);
    }

    public function getEstado($id)
    {
        $cita = Cita::findOrFail($id);
        return response()->json(['estado_cita' => $cita->estado_cita]);
    }

    // Método para confirmar la cita
    public function confirmar(Request $request, Cita $cita)
    {
        $cita->update(['estado_cita' => 'confirmada']);

        // Enviar correo electrónico al usuario informando que la cita ha sido confirmada
        Mail::to($cita->user->email)->send(new CitaConfirmada($cita));

        return view('citas.success', ['message' => 'Cita confirmada exitosamente.']);
    }

    // Método para denegar la cita
    public function denegar(Cita $cita)
    {
        $cita->update(['estado_cita' => 'anulada']);

        // Enviar correo electrónico al usuario informando que la cita ha sido denegada
        Mail::to($cita->user->email)->send(new CitaDenegada($cita));

        return view('citas.success', ['message' => 'Cita denegada exitosamente.']);
    }

    public function botonConfirmar(Cita $cita)
    {
        $cita->estado_cita = 'confirmada';
        $cita->save();

        return response()->json(['message' => 'Cita confirmada exitosamente.']);
    }

    public function botonAnular(Cita $cita)
    {
        $cita->estado_cita = 'anulada';
        $cita->save();

        return response()->json(['message' => 'Cita anulada exitosamente.']);
    }
}
