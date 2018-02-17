<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

/**
 * Responses
 */
Route::resource('/responses', 'ResponseController');

/**
 * Attachments
 */
Route::resource('/attachments', 'AttachmentController');

/**
 * Search
 */
Route::get('/search', 'SearchController@index')->name('search');

/**
 * Tickets
 */
Route::get('/tickets/create', 'TicketController@create')->name('ticket.create');
Route::post('/tickets/', 'TicketController@store')->name('ticket.store');
Route::get('/tickets/{id}', 'TicketController@show')->name('ticket.show');

/**
 * E-Mail activation controllers
 */
Route::group(['prefix' => 'activation', 'middleware' => ['guest'], 'as' => 'activation.'], function() {
    Route::get('/resend', 'Auth\ActivationResendController@index')->name('resend');
    Route::post('/resend', 'Auth\ActivationResendController@store')->name('resend.store');
    Route::get('/{confirmation_token}', 'Auth\ActivationController@activate')->name('activate');

});

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

/**
 * Admin
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    /**
     * Admin login
     */
    Route::get('/login', 'Admin\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Admin\LoginController@login')->name('login.submit');

    /**
     * Dashboard
     */
    Route::get('/', 'Admin\DashboardController@index')->name('dashboard');

    /**
     * Browsing tickets
     */
    Route::get('/browse/{id}/{status}', 'Admin\DashboardController@browse')->name('browse.department');
    Route::get('/browse/{id}/', 'Admin\DashboardController@browse');
    Route::get('/browse/', 'Admin\DashboardController@browse')->name('browse');
    Route::get('/department/tree', 'Admin\DepartmentController@tree')->name('department.tree');

    /**
     * Configuring departments
     */
    Route::resource('/departments', 'Admin\DepartmentController');

    /**
     * Configuring e-mail pipes
     */
    Route::resource('/pipes', 'Admin\PipeController');

    /**
     * Searching tickets
     */
    Route::get('/search', 'Admin\SearchController@index')->name('search');

    /**
     * Manipulating tickets
     */
    Route::resource('/ticket', 'Admin\TicketController');

    /**
     * Manipulating responses
     */
    Route::resource('/responses', 'Admin\ResponseController');

    /**
     * Manipulating users
     */
    Route::resource('/users', 'Admin\UserController');

    /**
     * Notes
     */
    Route::resource('/notes', 'Admin\NoteController');
    Route::get('/ticket/{ticket}/notes', 'Admin\NoteController@ticket');
    Route::get('/users/{user}/notes', 'Admin\NoteController@user');
});


