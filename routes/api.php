<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ping', function (Request $request) {
    return ['pong' => true];
});

Route::get('/notes', [NoteController::class, 'All']);

Route::get('/note/{id}', [NoteController::class, 'One']);

Route::post('/note', [NoteController::class, 'New']);

Route::put('/note/{id}', [NoteController::class, 'Edit']);

Route::delete('/note/{id}', [NoteController::class, 'Del']);
