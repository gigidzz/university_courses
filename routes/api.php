<?php

use App\Http\Controllers\API\TssuApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/faculties', [TssuApiController::class, 'index']);
    Route::post('/faculties', [TssuApiController::class, 'store']);
    Route::get('/faculties/{id}', [TssuApiController::class, 'show']);
    Route::put('/faculties/{id}', [TssuApiController::class, 'update']);
    Route::delete('/faculties/{id}', [TssuApiController::class, 'destroy']);
});

//Route::get('/test', function () {
//    return response()->json(['message' => 'API is working']);
//});
