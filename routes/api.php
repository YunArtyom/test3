<?php

use App\Http\Controllers\Balance\AddBalanceController;
use App\Http\Controllers\Balance\SendBalanceController;
use App\Http\Controllers\ClientUser\ClientController;
use Illuminate\Support\Facades\Route;


Route::prefix('business')->group(function () {
    Route::prefix('balance')->group(function () {
        Route::prefix('add')->group(function () {
            Route::get('create-initial', [AddBalanceController::class, 'createInitial']);
            Route::get('callback-close-initial', [AddBalanceController::class, 'callbackCloseInitial']);
        });
        Route::get('send', [SendBalanceController::class, 'send']);
    });
});


Route::prefix('client')->group(function () {
    Route::get('/{clientUser:mobile_number}', [ClientController::class, 'get'])
        ->missing(function () {
            return response()->json(['message' => 'Данного клиента не существует!', 'status' => 404], 404);
    });
});
