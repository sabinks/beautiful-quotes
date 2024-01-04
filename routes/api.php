<?php

use App\Http\Controllers\Next\WallpaperQuoteController as NextWallpaperQuoteController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\WallpaperQuoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/login', [AuthController::class, 'login']);

Route::post('get-user', [AuthController::class, 'getUser'])->middleware(['auth:api']);

Route::get('next-wallpaper-quotes', [NextWallpaperQuoteController::class, 'index']);
Route::resource('wallpaper-quotes', WallpaperQuoteController::class);
