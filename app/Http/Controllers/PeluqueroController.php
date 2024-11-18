<?php

namespace App\Http\Controllers;

use App\Models\Peluquero;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function create(Empresa $empresa)
    {
        // Pasar la empresa a la vista de creación
        return view('peluqueros.create', compact('empresa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Empresa $empresa)
    {
        // store() es el método que se encarga de guardar el nuevo peluquero en la base de datos
        $request->validate([
            'username' => 'required|unique:users',
            'name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'servicios' => 'required'
        ], [
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.unique' => 'El nombre de usuario ya está en uso.',
            'name.required' => 'El nombre es obligatorio.',
            'first_name.required' => 'El primer apellido es obligatorio.',
            'last_name.required' => 'El segundo apellido es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'imagen.required' => 'La imagen es obligatoria.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser un archivo de tipo: jpeg, png, jpg, gif, svg.',
            'imagen.max' => 'La imagen no debe ser mayor de 2048 kilobytes.',
            'servicios.required' => 'La descripción de los servicios es obligatoria.'
       
        
        ]
    );
        $imagePath = $request->file('imagen')->store('images', 'public');

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name, // Asegurarse de que el campo 'name' se envíe correctamente
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'peluquero',
        ]);

        $imagePath = $request->file('imagen')->store('images', 'public');

        Peluquero::create([
            'imagen' => $imagePath,
            'servicios' => $request->servicios,
            'empresa_id' => $empresa->id,
            'user_id' => $user->id,
        ]);

        return redirect()->route('empresas.peluqueros.index', $empresa)->with('success', 'Peluquero creado exitosamente.');
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
         $request->validate([
             'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'servicios' => 'required|string',
         ]);
 
         if ($request->hasFile('imagen')) {
             $imagePath = $request->file('imagen')->store('images', 'public');
             $peluquero->imagen = $imagePath;
         }
 
         $peluquero->servicios = $request->servicios;
         $peluquero->save();
 
         return redirect()->route('peluqueros.index')->with('success', 'Peluquero actualizado exitosamente.');
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa, Peluquero $peluquero)
    {
        // destroy() es el método que se encarga de eliminar un peluquero de la base de datos
        $peluquero->delete();

        return redirect()->route('empresas.peluqueros.index', $empresa)->with('success', 'Peluquero eliminado exitosamente.');
    }

    public function getPeluquerosByEmpresa(Empresa $empresa)
    {
        return response()->json($empresa->peluqueros()->with('user')->get()->map(function ($peluquero) {
            return [
                'id' => $peluquero->id,
                'name' => $peluquero->user->name,
                'servicios' => $peluquero->servicios,
            ];
        }));
    }
}
