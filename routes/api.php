<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PermissionController;

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
Route::prefix('inventory')->group(function(){

    Route::get('search', [InventoryController::class, 'search']);
    Route::get('addition', [InventoryController::class, 'addition']);
});
Route::post('permission/create', [PermissionController::class, 'store']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
