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
          Route::get('/users',[AdminController::class, 'indexUsers']);//回傳所有使用者
          Route::get('/users/{user}',[AdminController::class, 'showUser']);//回傳特定使用者
          Route::post('/commodities',[AdminController::class, 'storeComm']);//新增商品
          Route::delete('/commodities/{commodity}',[AdminController::class, 'destroyComm']);//刪除商品
          Route::put('/commodities/{commodity}',[AdminController::class, 'updateComm']);//更新商品
          Route::get('/comm_changes',[AdminController::class, 'indexCommChanges']);//回傳所有商品異動表
          Route::get('/comm_changes/{commodity}',[AdminController::class, 'showCommChanges']);//回傳特定商品異動表
          Route::post('/comm_changes',[AdminController::class, 'storeCommStock']);//新增商品庫存數量
          Route::post('/upload_pic',[AdminController::class, 'upload']);
          Route::get('/geturl',[AdminController::class, 'geturl']);
      });
});
Route::group([
    'middleware' => 'auth:api'
], function() {
    Route::get('/commodity_user',[CommodityUserController::class, 'indexComm']);
    Route::post('/commodity_users',[CommodityUserController::class, 'storeComm']);
});