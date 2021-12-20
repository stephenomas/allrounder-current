<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobileController;

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
Route::post('/branch/create', [MobileController::class, 'create']);
Route::get('/branch', [MobileController::class, 'index']);
Route::get('/branch/{branch}/edit', [MobileController::class, 'edit']);
Route::post('/branch/{branch}/edit', [MobileController::class, 'update']);
Route::post('/add-branch/{branch}/delete', [MobileController::class, 'delete']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
