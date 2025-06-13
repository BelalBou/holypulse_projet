<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'HolyPulse API is running!',
        'timestamp' => now(),
        'version' => '1.0.0'
    ]);
});

// Route::post('/login', [AuthController::class, 'login']); // Déplacé vers api.php


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout(); // Ajout du guard explicite

    // Supprime le token de session s’il existe
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return response()->json(['message' => 'Déconnecté avec succès']);
})->middleware('auth:sanctum');

// Route de test de santé
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'database' => 'connected',
        'timestamp' => now(),
        'environment' => app()->environment()
    ]);
});