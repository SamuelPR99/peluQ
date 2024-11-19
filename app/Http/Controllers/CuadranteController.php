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
            Cuadrante::create([
                'peluquero_id' => $request->peluquero_id,
                'fecha' => substr($event['start'], 0, 10),
                'hora_entrada' => substr($event['start'], 11, 8),
                'hora_salida' => substr($event['end'], 11, 8),
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
     * Show the form for editing the specified resource.
     */
    public function edit(Cuadrante $cuadrante)
    {
        // edit() es el método que muestra el formulario de edición de un cuadrante en particular
        return view('cuadrantes.edit', compact('cuadrante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cuadrante $cuadrante)
    {
        // update() es el método que se encarga de actualizar un cuadrante en la base de datos
        $request->validate([
            'fecha' => 'required',
            'hora' => 'required',
            'peluquero_id' => 'required',
            'servicio_id' => 'required',
        ]);

        $cuadrante->update($request->all());

        return redirect()->route('cuadrantes.index');
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

    public function calendario()
    {
        return view('calendario');
    }

    public function getCuadrantes()
    {
        $cuadrantes = Cuadrante::all();
        $events = $cuadrantes->map(function ($cuadrante) {
            return [
                'id' => $cuadrante->id,
                'title' => $cuadrante->servicio->nombre,
                'start' => $cuadrante->fecha . 'T' . $cuadrante->hora_entrada,
                'end' => $cuadrante->fecha . 'T' . $cuadrante->hora_salida,
            ];
        });

        return response()->json($events);
    }
}
