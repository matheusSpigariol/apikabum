<?php

use App\Http\Controllers\FreteController;
use Illuminate\Support\Facades\Route;


Route::prefix('frete')->group(function () {
    Route::post('/', [FreteController::class, 'listarFretes']);
});
