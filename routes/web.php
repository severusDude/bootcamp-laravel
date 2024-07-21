<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// standard routes
Route::get('/news/{id}', [NewsController::class, 'read_news']);

// admin routes
Route::group(['middleware' => ['role:admin']], function () {
    Route::any('/admin');
});

// editor routes
Route::group(['middleware' => ['role:admin|editor']], function () {
    Route::controller(NewsController::class)->group(function () {
        Route::post('/news/create', 'create_news');
        Route::put('/news/{id}', 'edit_news');
        Route::delete('/news/{id}', 'delete_news');
    });
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
