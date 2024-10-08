<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/user', [UserController::class, 'index']);
    Route::get('/users/{user}', [UserController::class, 'profile']);
    Route::get('/profile', [UserController::class, 'profile']);

    Route::post('/users/{user}/assign-permission', [UserController::class, 'assignPermission'])->name('users.assign-permission')->middleware('can:give permission');

    Route::get('/roles', [RoleController::class, 'index']);
    Route::get('/roles/{role}', [RoleController::class, 'roleDetail']);
    Route::post('/roles/{role}/update-permission', [RoleController::class, 'updateRolePermission'])->name('roles.update-permission')->middleware('can:give permission');
});