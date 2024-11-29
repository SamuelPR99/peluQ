<?php

namespace App\Http\Controllers;

use App\Models\Valoracion;
use Illuminate\Http\Request;

class ValoracionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // index() es el método que muestra un listado de todas las valoraciones
        $valoraciones = Valoracion::all();
        return view('valoraciones.index', compact('valoraciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // create() es el método que muestra el formulario de creación de una nueva valoración
        return view('valoraciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // store() es el método que se encarga de guardar la nueva valoración en la base de datos
        $request->validate([
            'puntuacion' => 'required',
            'comentario' => 'required',
            'peluquero_id' => 'required',
            'usuario_id' => 'required',
            'cita_id' => 'required',
        ]);

        Valoracion::create($request->all());

        return redirect()->route('valoraciones.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Valoracion $valoracion)
    {
        // show() es el método que muestra los detalles de una valoración en particular
        return view('valoraciones.show', compact('valoracion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Valoracion $valoracion)
    {
        // edit() es el método que muestra el formulario de edición de una valoración en particular
        return view('valoraciones.edit', compact('valoracion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Valoracion $valoracion)
    {
        // update() es el método que se encarga de actualizar una valoración en la base de datos
        $request->validate([
            'puntuacion' => 'required',
            'comentario' => 'required',
            'peluquero_id' => 'required',
            'usuario_id' => 'required',
            'cita_id' => 'required',
        ]);

        $valoracion->update($request->all());

        return redirect()->route('valoraciones.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Valoracion $valoracion)
    {
        // destroy() es el método que se encarga de eliminar una valoración de la base de datos
        $valoracion->delete();
        return redirect()->route('valoraciones.index');
    }
}
