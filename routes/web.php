<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $query = DB::table('properties')->get();
    return view('welcome',compact('query'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/property-create', [App\Http\Controllers\PropertyController::class, 'create'])->name('property-create');
Route::post('/property-store', [App\Http\Controllers\PropertyController::class, 'store'])->name('property-store');
Route::get('/property-edit/{id}', [App\Http\Controllers\PropertyController::class, 'edit'])->name('property-edit'); 
Route::put('/property-update/{id}', [App\Http\Controllers\PropertyController::class, 'update'])->name('property-update');
Route::get('/property-delete/{id}', [App\Http\Controllers\PropertyController::class, 'destroy'])->name('property-delete');  