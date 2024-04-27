<?php

use App\Http\Controllers\BroadcastController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::post('broadcasting/auth', [BroadcastController::class, 'authenticate']);

require __DIR__.'/auth.php';
