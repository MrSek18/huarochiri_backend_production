<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;

// Ruta pública de prueba
Route::get('/test', function () {
    return response()->json(['message' => 'API funcionando']);
});

// Autenticación
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {
    // Obtener datos del usuario autenticado
    Route::get('/user', function (Request $request) {
        return response()->json([
            'user' => [
                'id' => $request->user()->id,
                'name' => $request->user()->name,
                'email' => $request->user()->email,
                'role' => $request->user()->role ?? 'user', // Campo opcional con valor por defecto
                'created_at' => $request->user()->created_at->toISOString(), // Formato ISO
                'monto_aportado' => $request->user()->monto_aportado ?? 0, // Campo opcional con valor por defecto
                "dni" => $request->user()->dni ?? '', // Campo opcional con valor por defecto
                "celular" => $request->user()->celular ?? '' // Campo opcional con


            ]
        ]);
    });

    // Ejemplo de ruta protegida adicional
    Route::get('/protected-route', function () {
        return response()->json(['message' => 'Esta es una ruta protegida']);
    });
});
Route::post('/register', [AuthController::class, 'register']);
Route::put('/user/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');


use Illuminate\Support\Facades\DB;

Route::get('/test-db', function () {
    try {
        $clientes = DB::table('clientes')->get(); // Cambia 'clientes' por una tabla que exista en tu base
        return response()->json($clientes);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
});
