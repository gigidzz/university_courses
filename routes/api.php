<?php


use App\Http\Controllers\tssu;
use Illuminate\Support\Facades\Route;



Route::get('/faculties', [tssu::class, 'indexApi']);        // Get all faculties
Route::get('/faculties/{id}', [tssu::class, 'showApi']);    // Get a single faculty
Route::post('/faculties', [tssu::class, 'storeApi']);       // Create a new faculty
Route::put('/faculties/{id}', [tssu::class, 'updateApi']);  // Update an existing faculty
Route::delete('/faculties/{id}', [tssu::class, 'destroyApi']);  // Delete a faculty
