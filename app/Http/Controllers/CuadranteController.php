<?php

namespace App\Http\Controllers;

use App\Models\Cuadrante;
use Illuminate\Http\Request;

class CuadranteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // index() es el método que muestra un listado de todos los cuadrantes
        $cuadrantes = Cuadrante::all();
        return view('cuadrantes.index', compact('cuadrantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // create() es el método que muestra el formulario de creación de un nuevo cuadrante
        $peluquero_id = $request->input('peluquero_id');
        $peluquero = \App\Models\Peluquero::with('user')->find($peluquero_id);
        $existingEvents = Cuadrante::where('peluquero_id', $peluquero_id)->get()->map(function ($cuadrante) {
            return [
                'start' => $cuadrante->fecha . 'T' . $cuadrante->hora_entrada,
                'end' => $cuadrante->fecha . 'T' . $cuadrante->hora_salida,
            ];
        });
        return view('cuadrantes.create', compact('peluquero_id', 'existingEvents', 'peluquero'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // store() es el método que se encarga de guardar el nuevo cuadrante en la base de datos
        $request->validate([
            'peluquero_id' => 'required',
            'events' => 'required|json',
            'deletedEvents' => 'nullable|json',
        ]);

        $events = json_decode($request->events, true);
        $deletedEvents = json_decode($request->deletedEvents, true);

        // Eliminar todos los cuadrantes existentes del peluquero
        Cuadrante::where('peluquero_id', $request->peluquero_id)->delete();

        foreach ($events as $event) {
            $start = new \DateTime($event['start']);
            $end = new \DateTime($event['end']);
            $start->setTimezone(new \DateTimeZone('Europe/Madrid'));
            $end->setTimezone(new \DateTimeZone('Europe/Madrid'));

            Cuadrante::create([
                'peluquero_id' => $request->peluquero_id,
                'fecha' => $start->format('Y-m-d'),
                'hora_entrada' => $start->format('H:i:s'),
                'hora_salida' => $end->format('H:i:s'),
            ]);
        }

        $peluquero = \App\Models\Peluquero::find($request->peluquero_id);
        $empresa = $peluquero->empresa;

        return redirect()->route('empresas.peluqueros.index', $empresa);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cuadrante $cuadrante)
    {
        // show() es el método que muestra los detalles de un cuadrante en particular
        return view('cuadrantes.show', compact('cuadrante'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cuadrante $cuadrante)
    {
        // destroy() es el método que se encarga de eliminar un cuadrante de la base de datos
        $cuadrante->delete();

        return redirect()->route('cuadrantes.index');
    }

    public function getCuadrantes()
    {
        $cuadrantes = Cuadrante::all();
        $events = $cuadrantes->map(function ($cuadrante) {
            return [
                'id' => $cuadrante->id,
                'title' => 'Horas',
                'start' => $cuadrante->fecha . 'T' . $cuadrante->hora_entrada,
                'end' => $cuadrante->fecha . 'T' . $cuadrante->hora_salida,
                'backgroundColor' => '#38b2ac', // Color teal
                'borderColor' => '#38b2ac', // Color teal
            ];
        });

        return response()->json($events);
    }
}
