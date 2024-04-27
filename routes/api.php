<?php

use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ChannelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/cards', [CardController::class, 'cards'])->name('cards');
    Route::post('/card', [CardController::class, 'card'])->name('card');
    Route::post('/sendWhatsappMessage', [CardController::class, 'sendWhatsappMessage'])->name('sendWhatsappMessage');

    Route::post('broadcasting/auths', [BroadcastController::class, 'authenticate']);

    Route::get('/channels', [ChannelController::class, 'index']);
    Route::post('/channels', [ChannelController::class, 'store']);
    Route::get('/channels/{channel}', [ChannelController::class, 'show']);
    Route::put('/channels/{channel}', [ChannelController::class, 'update']);
    Route::delete('/channels/{channel}', [ChannelController::class, 'destroy']);
});
