<?php

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\Tssu;

Route::get('/', function () {
    return redirect('/faculties');
});


Route::get('/faculties', [Tssu::class, 'index'])->name('faculties.index');
Route::get('/faculties/create', [Tssu::class, 'create'])->name('faculties.create');
Route::post('/faculties', [Tssu::class, 'store'])->name('faculties.store');
Route::get('/faculties/{id}', [Tssu::class, 'show'])->name('faculties.show');
Route::get('/faculties/{id}/edit', [Tssu::class, 'edit'])->name('faculties.edit');
Route::put('/faculties/{id}', [Tssu::class, 'update'])->name('faculties.update');
Route::delete('/faculties/{id}', [Tssu::class, 'destroy'])->name('faculties.destroy');
