<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('dashboard');

Route::get('/create-user', [UserController::class, 'create'])->name('user.create'); 

Route::post('/store-user', [UserController::class, 'store'])->name('user.store'); 