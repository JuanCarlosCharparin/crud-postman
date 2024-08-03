<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str; // Importa la clase para generar UUIDs

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6', // Asegúrate de encriptar la contraseña
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'phone_2' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
        ]);

        $user = User::create([
            'uid' => Str::uuid()->toString(), // Genera un UUID único
            'first_name' => $validated['first_name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'phone_2' => $validated['phone_2'],
            'postal_code' => $validated['postal_code'],
            'birth_date' => $validated['birth_date'],
            'gender' => $validated['gender'],
        ]);

        return response()->json($user, 201); 
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        // Validar los datos recibidos
        $validated = $request->validate([
            'first_name' => 'required|string',
            'email' => ['required', 'string', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => 'nullable|string|min:6', // La contraseña es opcional en la actualización
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'phone_2' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
        ]);

        // Actualizar el usuario
        $user->update([
            'first_name' => $validated['first_name'],
            'email' => $validated['email'],
            'password' => isset($validated['password']) ? bcrypt($validated['password']) : $user->password,
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'phone_2' => $validated['phone_2'],
            'postal_code' => $validated['postal_code'],
            'birth_date' => $validated['birth_date'],
            'gender' => $validated['gender'],
        ]);

        // Retornar la respuesta JSON
        return response()->json($user, 200);
    }

    public function destroy(User $user)
    {
        $user->delete(); // Elimina el usuario
        return response()->json(null, 204); // Devuelve un código 204 sin contenido
    }
}
