<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// standard routes
Route::get('/news/{id}', function (string $id) {
    return;
});

// admin routes
Route::group(['middleware' => ['role:admin']], function () {
    Route::any('/admin');
});

// editor routes
Route::group(['middleware' => ['role:admin|editor']], function () {
    return;
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
