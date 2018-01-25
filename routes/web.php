<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('/departments', 'DepartmentController');

Route::get('/activation/activate/{confirmation_token}', 'Auth\ActivationController@activate')->name('activation.activate');

Route::group(['prefix' => 'account', 'middleware' => ['auth'], 'as' => 'account.'], function() {
    /**
     * Account
     */
    Route::get('/', 'Account\AccountController@index')->name('index');

    /**
     * Profile
     */
    Route::get('profile', 'Account\ProfileController@index')->name('profile.index');
    Route::post('profile', 'Account\ProfileController@store')->name('profile.store');

    /**
     * Password
     */
    Route::get('password', 'Account\PasswordController@index')->name('password.index');
    Route::post('password', 'Account\PasswordController@store')->name('password.store');
});


