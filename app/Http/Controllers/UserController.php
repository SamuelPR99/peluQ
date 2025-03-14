<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cita;

class UserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // store() es el método que se encarga de guardar el nuevo usuario en la base de datos
        $request->validate([
            'username' => 'required|unique:users',
            'name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        User::create($request->all());

        return redirect()->route('users.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // update() es el método que se encarga de actualizar los datos de un usuario en la base de datos
        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // destroy() es el método que se encarga de eliminar un usuario de la base de datos
        $user->delete();
        return redirect()->route('users.index');
    }

    public function getAndUpdateCitasExpiradasAjax()
    {
    
        // Obtener citas expiradas y actualizarlas
        $citasExpiradas = Cita::where('user_id', Auth::id())
            ->where(function ($query) {
                $query->where('fecha_cita', '<', now()->format('Y-m-d'))
                      ->orWhere(function ($query) {
                          $query->where('fecha_cita', now()->format('Y-m-d'))
                                ->where('hora_cita', '<', now()->format('H:i:s'));
                      });
            })
            ->get()
            ->each(function ($cita) {
                $cita->update(['estado_cita' => 'expirada']);
            });
    
        // Retornar las citas expiradas como respuesta JSON
        return response()->json(['citas_actualizadas' => $citasExpiradas->pluck('id')]);
    }



}
