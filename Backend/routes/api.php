<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

//region users
Route::post('users/login', [UserController::class, 'login']);
Route::post('users/logout', [UserController::class, 'logout']);
Route::get('users', [UserController::class, 'index'])
    ->middleware('auth:sanctum');

Route::get('users/{id}', [UserController::class, 'show'])
    ->middleware('auth:sanctum');
Route::post('users', [UserController::class, 'store'])
    ->middleware('auth:sanctum');    
Route::patch('users/{id}', [UserController::class, 'update'])
    ->middleware('auth:sanctum');    
Route::delete('users/{id}', [UserController::class, 'destroy'])
    ->middleware('auth:sanctum');    
//endregion

//region API teszt
Route::get('/', function(){
    return 'API';
});
//endregion

Route::get('/', function(){
    return 'API';
});