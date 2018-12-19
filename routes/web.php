<?php

Route::middleware('maintenance')->group(function () {
    Route::view('/', 'style.home');

});

Route::view('/maintenance', 'style.maintenance')->middleware('maintenance:close')->name('maintenance');