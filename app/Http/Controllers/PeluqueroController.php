<?php

namespace App\Http\Controllers;

use App\Models\Peluquero;
use App\Models\Empresa;
use Illuminate\Http\Request;

class PeluqueroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Empresa $empresa)
    {
        // Mostrar solo los peluqueros de la empresa especificada
        $peluqueros = $empresa->peluqueros;
        return view('peluqueros.index', compact('peluqueros', 'empresa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // create() es el método que muestra el formulario de creación de un nuevo peluquero
        return view('peluqueros.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // store() es el método que se encarga de guardar el nuevo peluquero en la base de datos
        $request->validate([
            'nombre' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // La imagen es obligatoria y debe ser una imagen
            'servicios' => 'required'
        ]);
        $imagePath = $request->file('imagen')->store('images', 'public');

        Peluquero::create([
            'nombre' => $request->nombre,
            'imagen' => $imagePath,
            'servicios' => $request->servicios,
        ]);

        return redirect()->route('peluqueros.index')->with('success', 'Peluquero creado exitosamente.');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Peluquero $peluquero)
    {
        // show() es el método que muestra los detalles de un peluquero en particular
        return view('peluqueros.show', compact('peluquero'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peluquero $peluquero)
    {
        // edit() es el método que muestra el formulario de edición de un peluquero en particular
        return view('peluqueros.edit', compact('peluquero'));
    }

    /**
     * Update the specified resource in storage.
     */
    
     public function update(Request $request, Peluquero $peluquero)
     {
        $
         $request->validate([
             'nombre' => 'required|string|max:255',
             'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'servicios' => 'required|string',
         ]);
 
         if ($request->hasFile('imagen')) {
             $imagePath = $request->file('imagen')->store('images', 'public');
             $peluquero->imagen = $imagePath;
         }
 
         $peluquero->nombre = $request->nombre;
         $peluquero->servicios = $request->servicios;
         $peluquero->save();
 
         return redirect()->route('peluqueros.index')->with('success', 'Peluquero actualizado exitosamente.');
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peluquero $peluquero)
    {
        // destroy() es el método que se encarga de eliminar un peluquero de la base de datos
        $peluquero->delete();

        return redirect()->route('peluqueros.index');
    }
}
