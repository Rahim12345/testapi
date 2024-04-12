<?php


use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('login',[AuthController::class,'login']);


Route::middleware('auth:api')->group(function (){
    Route::get('users',[AuthController::class,'users']);
});
