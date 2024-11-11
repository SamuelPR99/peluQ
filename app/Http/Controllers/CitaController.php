<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

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
        return view('citas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // store() es el método que se encarga de guardar la nueva cita en la base de datos
        $request->validate([
            'fecha' => 'required',
            'hora' => 'required',
            'motivo' => 'required',
            'paciente_id' => 'required',
            'medico_id' => 'required',
        ]);

        Cita::create($request->all());

        return redirect()->route('citas.index');
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
            'fecha' => 'required',
            'hora' => 'required',
            'motivo' => 'required',
            'paciente_id' => 'required',
            'medico_id' => 'required',
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

        return redirect()->route('citas.index');
    }
}
