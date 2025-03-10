<?php

namespace App\Http\Controllers;

use App\Models\Valoracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

class ValoracionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // index() es el método que muestra un listado de todas las valoraciones
        $valoraciones = Valoracion::all();
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($citaId)
    {
        // create() es el método que muestra el formulario de creación de una nueva valoración
        return view('valoraciones.create', compact('citaId')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $citaId)
    {

        try {
            // Registrar un mensaje informativo
    
            $request->validate([
                'cuerpo_valoracion' => 'required|string|max:255',
                'puntuacion' => 'required|integer|between:1,5',
            ]);
    
            Valoracion::create([
                'cuerpo_valoracion' => $request->cuerpo_valoracion,
                'puntuacion' => $request->puntuacion,
                'user_id' => Auth::id(),
                'cita_id' => $citaId,
            ]);

            return redirect()->route('valoraciones.index')->with('success', 'Valoración guardada correctamente.');

        } catch (\Exception $e) {
            Log::error('Error al crear la valoracion:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->withErrors('Error al crear la valoracion. Por favor, inténtelo de nuevo.');
        }
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
            'cuerpo_valoracion' => 'required',
            'empresa_id' => 'nullable',
            'user_id' => 'required',
            'cita_id' => 'required',
        ], [
            'cuerpo_valoracion.required' => 'Campo obligatorio.',
        ]);

        $valoracion->update($request->all());

        return redirect()->route('valoraciones.create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Valoracion $valoracion)
    {
        $valoracion->delete();

        return redirect()->route('dashboard');
    }

    public function checkValoracion($citaId)
    {
        $tiene_valoracion = Valoracion::where('cita_id', $citaId)->exists();
        return response()->json(['tiene_valoracion' => $tiene_valoracion]);
    }
}