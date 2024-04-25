<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

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
        $passwordHash = Hash::make($request->password);
        $user = User::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'numero' => $request->numero,
            'email' => $request->email,
            'password' => $passwordHash,
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
        $passwordHash = Hash::make($request->password);
        $user->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'numero' => $request->numero,
            'email' => $request->email,
            'password' => $passwordHash,
        ]);

        return response()->json(['message' => 'Usuario actualizado correctamente', 'user' => $user],  Response::HTTP_OK);
    }

    public function destroy(User $user)
    {
        $user->update([
            'activo' => false
        ]);

        return response()->json(['message' => 'Usuario eliminado correctamente'],  Response::HTTP_OK);
    }
}
