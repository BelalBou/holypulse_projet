<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\VerseCommentController;
use App\Http\Controllers\API\VerseLikeController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/verses/random', [VerseController::class, 'random']);

Route::get('/verses/{id}', [VerseController::class, 'show']);


Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/likes', [VerseLikeController::class, 'index']);
    Route::post('/verses/{id}/like', [VerseLikeController::class, 'toggle']);
});

Route::get('/likes/verses', [VerseLikeController::class, 'likedVerses']);

Route::get('/comments/verses', [VerseCommentController::class, 'commentedVerses']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/verses/{verse}/comments', [VerseCommentController::class, 'index']);
    Route::post('/verses/{verse}/comments', [VerseCommentController::class, 'store']);
});

// Route de test API
Route::get('/test', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'API is working!',
        'timestamp' => now()
    ]);
});
