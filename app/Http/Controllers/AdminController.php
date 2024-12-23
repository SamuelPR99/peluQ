<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Empresa;

class AdminController extends Controller
{
    /**
     * Listado de usuarios
     */
    public function usuarios()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function empresas()
    {
        $empresas = Empresa::all();
        return view('empresas.ver-empresas', compact('empresas'));
    }

    public function borrarUsuario(User $user)
    {
        $user->delete();
        return redirect()->route('admin.usuarios');
    }

    public function borrarEmpresa(Empresa $empresa)
    {
        $empresa->delete();
        return redirect()->route('empresas.index');
    }

    public function editarUsuario(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function editarEmpresa(Empresa $empresa)
    {
        return view('empresas.edit', compact('empresa'));
    }

    public function actualizarUsuario(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index');
    }

    public function actualizarEmpresa(Request $request, Empresa $empresa)
    {
        $request->validate([
            'nombre_empresa' => 'required',
            'email' => 'required|email',
            'telefono' => 'required|digits:9',
            'direccion' => 'required',
            'codigo_postal' => 'required',
            'confirmar_subscripcion' => 'required',
            'tipo_empresa' => 'required|in:peluqueria,barberia,peluqueria y barberia',
            'servicios' => 'required|array',
            'servicios.*.servicio' => 'required|string',
            'servicios.*.precio' => 'required|numeric',
        ], [
            'nombre_empresa.required' => 'El nombre de la empresa es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'telefono.digits' => 'El teléfono debe tener 9 dígitos.',
            'telefono.request' => 'Debe introducir un número de teléfono.',
            'direccion.required' => 'La dirección es obligatoria.',
            'servicios.required' => 'Debe proporcionar al menos un servicio.',
            'servicios.*.servicio.required' => 'El nombre del servicio es obligatorio.',
            'servicios.*.precio.required' => 'El precio del servicio es obligatorio.',
        ]);

        $empresa->update($request->all());

        return redirect()->route('empresas.index');
    }

    public function crearUsuario()
    {
        return view('users.create');
    }

    public function buscarUsuario(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('name', 'like', '%' . $search . '%')
            ->orWhere('first_name', 'like', '%' . $search . '%')
            ->orWhere('last_name', 'like', '%' . $search . '%')
            ->orWhere('username', 'like', '%' . $search . '%')
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    public function buscarEmpresa(Request $request)
    {
        $empresas = Empresa::where('nombre_empresa', 'like', '%' . $request->search . '%')
            ->orWhere('email', 'like', '%' . $request->search . '%')
            ->orWhere('telefono', 'like', '%' . $request->search . '%')
            ->orWhere('direccion', 'like', '%' . $request->search . '%')
            ->get();

        return view('empresas.ver-empresas', compact('empresas'));
    }

    

    
}