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
Route::post('/search', [App\Http\Controllers\HomeController::class, 'index'])->name('search');
Route::get('/agent-create', [App\Http\Controllers\AgentController::class, 'create'])->name('agent-create');
Route::post('/agent-store', [App\Http\Controllers\AgentController::class, 'store'])->name('agent-store');
Route::get('/agent-index', [App\Http\Controllers\AgentController::class, 'index'])->name('agent-index');