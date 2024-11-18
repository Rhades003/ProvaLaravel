<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 


class UserController extends Controller {

    public function login(Request $request) {
        $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Login completado',
                'user' => Auth::user(),
            ]);
        }

        return response()->json(['error' => 'ICredenciales incorrectas'], 401);
}

    public function signup(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        return response()->json([
            'message' => 'User registrado correctamente',
            'user' => $user,
        ]);
    }

    public function editUser(Request $request) {
    $validatedData = $request->validate([
        'user_id' => 'required|exists:users,id',
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $request->user_id,
        'phone' => 'nullable|string|max:15'
    ]);

    $user = User::findOrFail($validatedData['user_id']);
    $user->update([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'phone' => $validatedData['phone']
    ]);

    return response()->json(['message' => 'Datos de usuario actualizados correctamente', 'user' => $user]);
}

public function changePassword(Request $request) {
    $validatedData = $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|string|min:8' 
    ]);

    $user = User::where('email', $validatedData['email'])->firstOrFail();
    
    $user->update(['password' => Hash::make($validatedData['password'])]);

    return response()->json(['message' => 'Contraseña actualizada correctamente']);
}

public function forgotPassword(Request $request) {
    $validatedData = $request->validate([
        'email' => 'required|email|exists:users,email', 
    ]);
    //Aquí se podría enviar el correo y hacer la lógica

    return response()->json(['message' => 'Correo enviado']);
}
}
