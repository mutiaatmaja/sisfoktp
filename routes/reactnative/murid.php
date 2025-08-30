<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReactNative\MuridController;

Route::middleware('api')->prefix('murid')->group(function () {
    Route::get('/', [MuridController::class, 'index']); // List all murid
    Route::post('/', [MuridController::class, 'store']); // Add murid
    Route::put('/{id}', [MuridController::class, 'update']); // Update murid
    Route::delete('/{id}', [MuridController::class, 'destroy']); // Delete murid
    Route::post('/{id}/photo', [MuridController::class, 'uploadPhoto']); // Upload murid photo
});
