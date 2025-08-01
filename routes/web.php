<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('index');})->name('dashboard');

Route::get('/list-user', [UserController::class, 'list'])->name('user.list');
Route::get('/show-user/{user}', [UserController::class, 'show'])->name('user.show');

Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
Route::post('/store-user', [UserController::class, 'store'])->name('user.store');

Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/update-user/{user}', [UserController::class, 'update'])->name('user.update');
Route::get('/edit-user-password/{user}', [UserController::class, 'editPassword'])->name('user.edit-password');
Route::put('/update-user-password/{user}', [UserController::class, 'updatePassword'])->name('user.update-password');

Route::delete('/erase-user/{user}', [UserController::class, 'erase'])->name('user.erase');

Route::get('/generate-pdf-user/{user}', [UserController::class, 'generatePDF'])->name('user.generate-pdf');