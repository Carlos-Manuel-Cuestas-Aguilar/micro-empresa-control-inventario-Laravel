<?php

use App\Http\Controllers\AuthenticatedController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;
/*
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
*/
Route::get('ziggy', fn() => response()->json(new \Tighten\Ziggy\Ziggy()));

Route::post('login', [AuthenticatedController::class, 'login'])->name('login');
Route::get('validLogin', fn () => 'OK')->name('valid-login')->middleware('auth:sanctum');
Route::post('logout', [AuthenticatedController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
Route::apiResource('users', UserController::class)->middleware('auth:sanctum');
Route::apiResource('proveedores', ProveedorController::class)->middleware('auth:sanctum');
Route::apiResource('productos', ProductoController::class)->middleware('auth:sanctum');
Route::apiResource('ventas', VentaController::class)->middleware('auth:sanctum');
