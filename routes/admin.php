<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth','admin'])->group(function () { 

    Route::view('/admin', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/edit-user/{user}', 'admin.edit-user')->name('admin.edit-user');
});