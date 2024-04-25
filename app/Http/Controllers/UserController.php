<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
class UserController extends Controller
{
    public function index()
    {
        $users = User::where('activo', true)->get();
        return response()->json(['users' => $users],  Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'numero' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'numero' => $request->numero,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'activo' => true,
        ]);

        return response()->json(['message' => 'Usuario creado correctamente', 'user' => $user], Response::HTTP_CREATED);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'numero' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|min:8',
        ]);

        $user->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'numero' => $request->numero,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['message' => 'Usuario actualizado correctamente', 'user' => $user],  Response::HTTP_ok);
    }

    public function destroy(User $user)
    {
        $user->update([
            'activo' => false
        ]);

        return response()->json(['message' => 'Usuario eliminado correctamente'],  Response::HTTP_OK);
    }
}
