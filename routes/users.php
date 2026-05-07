<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () { 

    Route::view('/spin', 'users.spin')->name('spin');
    Route::view('/withdraw', 'users.withdraw')->name('withdraw');
    Route::view('/withdraw-history', 'users.withdraw-history')->name('withdraw-history');
    Route::view('/pin', 'users.pin')->name('pin');
});