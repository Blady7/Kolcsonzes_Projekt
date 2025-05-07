<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpecimenController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QueriesController;
use App\Http\Middleware\CheckAbilities;

Route::get('/', function () {
    return 'API';
});

//region users
Route::post('users/login', [UserController::class, 'login']);
Route::post('users/logout', [UserController::class, 'logout']);
Route::get('queryDiakValaszto/{limit}/{offset}', [QueriesController::class, 'queryDiakValaszto']);
Route::get('queryTanarnevsor', [QueriesController::class, 'queryTanarnevsor']);
Route::get('queryStudentsCount', [QueriesController::class, 'queryStudentsCount']);
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

//region books
Route::get('books', [BookController::class, 'index']);
Route::get('books/{id}', [BookController::class, 'show']);
Route::get('queryOsztalyAzon/{limit}/{offset}', [QueriesController::class, 'queryOsztalyAzon']);
Route::get('queryBooksCount', [QueriesController::class, 'queryBooksCount']);
Route::post('books', [BookController::class, 'store'])
    ->middleware('auth:sanctum');
Route::patch('books/{id}', [BookController::class, 'update'])
    ->middleware('auth:sanctum');
Route::delete('books/{id}', [BookController::class, 'destroy'])
    ->middleware('auth:sanctum');
//endregion

//region groups
Route::get('groups', [GroupController::class, 'index']);
Route::get('queryTanarValaszto', [QueriesController::class, 'queryTanarValaszto']);
Route::post('groups', [GroupController::class, 'store'])
    ->middleware('auth:sanctum');

Route::patch('groups/{id}', [GroupController::class, 'update'])
    ->middleware('auth:sanctum');

Route::delete('groups/{id}', [GroupController::class, 'destroy'])
    ->middleware('auth:sanctum');

//endregion

//region rentals
Route::get('rentals', [RentalController::class, 'index']);
Route::get('queryKolcsonzesAzon/{limit}/{offset}', [ QueriesController::class, 'queryKolcsonzesAzon']);
Route::get('queryRentalsCount', [QueriesController::class, 'queryRentalsCount']);
Route::get('rentals/{id}', [RentalController::class, 'show']);
Route::post('rentals', [RentalController::class, 'store'])
    ->middleware('auth:sanctum');

Route::patch('rentals/{id}', [RentalController::class, 'update'])
    ->middleware('auth:sanctum');

Route::delete('rentals/{id}', [RentalController::class, 'destroy'])
    ->middleware('auth:sanctum');

//endregion

//region roles
Route::get('roles', [RoleController::class, 'index']);
Route::get('roles/{id}', [RoleController::class, 'show']);
Route::post('roles', [RoleController::class, 'store'])
    ->middleware('auth:sanctum');

Route::patch('roles/{id}', [RoleController::class, 'update'])
    ->middleware('auth:sanctum');

Route::delete('roles/{id}', [RoleController::class, 'destroy'])
    ->middleware('auth:sanctum');

//endregion

//region specimens
Route::get('specimens', [SpecimenController::class, 'index']);
Route::get('specimens/{id}', [SpecimenController::class, 'show']);
Route::post('specimens', [SpecimenController::class, 'store'])
    ->middleware('auth:sanctum');

Route::patch('specimens/{id}', [SpecimenController::class, 'update'])
    ->middleware('auth:sanctum');

Route::delete('specimens/{id}', [SpecimenController::class, 'destroy'])
    ->middleware('auth:sanctum');    

//endregion