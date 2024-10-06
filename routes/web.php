<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/property-create', [App\Http\Controllers\PropertyController::class, 'create'])->name('property-create');
Route::post('/property-store', [App\Http\Controllers\PropertyController::class, 'store'])->name('property-store');