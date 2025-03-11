<?php

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\tssu;

Route::get('/', function () {
    return redirect('/faculties');
});


Route::get('/faculties', [tssu::class, 'index'])->name('faculties.index');
Route::get('/faculties/create', [tssu::class, 'create'])->name('faculties.create');
Route::post('/faculties', [tssu::class, 'store'])->name('faculties.store');
Route::get('/faculties/{id}', [tssu::class, 'show'])->name('faculties.show');
Route::get('/faculties/{id}/edit', [tssu::class, 'edit'])->name('faculties.edit');
Route::put('/faculties/{id}', [tssu::class, 'update'])->name('faculties.update');
Route::delete('/faculties/{id}', [tssu::class, 'destroy'])->name('faculties.destroy');
