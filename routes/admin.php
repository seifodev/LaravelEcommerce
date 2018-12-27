<?php

/**
 * guest and admin middleware
 */

config()->set('auth.defaults.guard', 'admin');

// Allowed Only For Guests(Not Admin)
Route::middleware('guest:admin')->group(function () {
    Route::get('login', 'AuthController@loginForm')->name('admin.login');
    Route::post('login', 'AuthController@login');
    Route::get('password/reset', 'AuthController@passwordForgotForm')->name('admin.password.forgot');
    Route::post('password/reset', 'AuthController@sendResetEmail');
    Route::get('password/reset/{token}', 'AuthController@passwordResetForm')->name('admin.password.reset');
    Route::post('password/reset/{token}', 'AuthController@reset');
});

// Allowed Only For Authenticated Admins
Route::middleware('admin')->group(function () {

    // Admins Controller
    Route::resource('admins', 'AdminController');
    Route::delete('admins/destroy/all', 'AdminController@destroyAll')->name('admins.destroy.all');

    // Users Controller
    Route::resource('users', 'UserController');
    Route::delete('users/destroy/all', 'UserController@destroyAll')->name('users.destroy.all');

    // Countries Controller
    Route::resource('countries', 'CountryController');
    Route::delete('countries/destroy/all', 'CountryController@destroyAll')->name('countries.destroy.all');

    // Cities Controller
    Route::resource('cities', 'CityController');
    Route::delete('cities/destroy/all', 'CityController@destroyAll')->name('cities.destroy.all');

    // States Controller
    Route::resource('states', 'StateController');
    Route::delete('states/destroy/all', 'StateController@destroyAll')->name('states.destroy.all');

    // Departments Controller
    Route::resource('departments', 'DepartmentController');
    Route::delete('departments/destroy/all', 'DepartmentController@destroyAll')->name('departments.destroy.all');

    // Trademarks Controller
    Route::resource('trademarks', 'TrademarkController');
    Route::delete('trademarks/destroy/all', 'TrademarkController@destroyAll')->name('trademarks.destroy.all');

    // Manufactures Controller
    Route::resource('manufactures', 'ManufactureController');
    Route::delete('manufactures/destroy/all', 'ManufactureController@destroyAll')->name('manufactures.destroy.all');

    // Shipping Controller
    Route::resource('shippings', 'ShippingController');
    Route::delete('shippings/destroy/all', 'ShippingController@destroyAll')->name('shippings.destroy.all');

    // Mall Controller
    Route::resource('malls', 'MallController');
    Route::delete('malls/destroy/all', 'MallController@destroyAll')->name('malls.destroy.all');

    // Color Controller
    Route::resource('colors', 'ColorController');
    Route::delete('colors/destroy/all', 'ColorController@destroyAll')->name('colors.destroy.all');

    Route::view('', 'admin.home')->name('admin.index');
    Route::post('logout', 'AuthController@logout')->name('admin.logout');

    // Settings
    Route::get('settings', 'SettingController@settingsForm')->name('admin.settings');
    Route::post('settings', 'SettingController@settings');





    // Localization
    Route::get('lang/{lang}', function ($lang) {
        $lang = in_array($lang, config('app.locales')) ? $lang : settings()->lang;
        session()->has('lang') ? session()->forget('lang') : NULL;
        session()->put('lang', $lang);
        return back();
    })->name('lang');

    Route::get('test', function () {
        dd(departsJson());
    });
});