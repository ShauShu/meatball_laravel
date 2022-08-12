<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommodityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommodityUserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'prefix' => 'users'
], function () {
    Route::post('/login',[AuthController::class, 'login']);
    Route::post('/signup',[AuthController::class, 'signup']);

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('/logout',[AuthController::class, 'logout']);
        Route::get('/currentUser',[AuthController::class, 'user']);
        Route::put('/currentUser',[AuthController::class, 'updateUser']);
    });
});
Route::group([
    'middleware' => 'auth:api'
], function() {
    Route::get('/commodities',[CommodityController::class, 'index']);
    Route::get('/commodity/{commodity}',[CommodityController::class, 'show']);
});
Route::group([
    'prefix' => 'admin'
], function () {
    Route::post('/login',[AdminController::class, 'adminLogin']);

    Route::group([
        'middleware' => 'auth:api'
      ], function() {
          Route::get('/users',[AdminController::class, 'indexUsers']);
          Route::get('/users/{user}',[AdminController::class, 'showUser']);
          Route::post('/commodities',[AdminController::class, 'storeComm']);
          Route::delete('/commodities/{commodity}',[AdminController::class, 'destroyComm']);
          Route::put('/commodities/{commodity}',[AdminController::class, 'updateComm']);
      });
});
Route::group([
    'middleware' => 'auth:api'
], function() {
    Route::get('/commodity_user',[CommodityUserController::class, 'indexComm']);
});