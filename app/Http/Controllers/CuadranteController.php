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
    public function create()
    {
        // create() es el método que muestra el formulario de creación de un nuevo cuadrante
        return view('cuadrantes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // store() es el método que se encarga de guardar el nuevo cuadrante en la base de datos
        $request->validate([
            'fecha' => 'required',
            'hora' => 'required',
            'peluquero_id' => 'required',
            'servicio_id' => 'required',
        ]);

        Cuadrante::create($request->all());

        return redirect()->route('cuadrantes.index');
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
}
