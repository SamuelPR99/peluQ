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
            'imagen' => 'required|image', // La imagen es obligatoria y debe ser una imagen
            'servicios' => 'required'
        ]);

        Peluquero::create($request->all());

        return redirect()->route('peluqueros.index');
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
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required',
            'imagen' => 'nullable|image', // La imagen no es obligatoria, pero si se proporciona, debe ser una imagen
            'servicios' => 'required'
        ]);

        // Si se proporciona una nueva imagen, procesarla y actualizar el campo de la imagen
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('public/imagenes');
            $peluquero->imagen = basename($path);
        }

        // Actualizar los demás campos
        $peluquero->nombre = $request->nombre;
        $peluquero->servicios = $request->servicios;
        $peluquero->save();

        return redirect()->route('peluqueros.index');
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
