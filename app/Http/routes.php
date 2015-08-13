<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function () {
    return view('pages.welcome');
});

Route::group([
    'namespace'  => 'Admin',
    'middleware' => 'auth',
], function () {
    Route::get('admin/dashboard', function () {
        return view('pages.dashboard');
    });
    Route::resource('admin/clients', 'ClientsController');
    Route::resource('admin/screengroups', 'ScreenGroupsController');
    Route::resource('admin/screens', 'ScreensController');
    Route::resource('admin/images', 'ImagesController');
    Route::resource('admin/events', 'EventsController');
    Route::resource('admin/eventmetas', 'EventMetasController');
});

Route::controllers([
    'auth' => 'Auth\AuthController',
]);

/**
 * Top menu
 */
Menu::make('topNav', function ($menu) {

    $menu->add('Home');
    $menu->add('Dashboard', 'admin/dashboard');
    $menu->add('Profile', 'profile');
    $menu->add('Help', 'help');
});

/**
 * Side menu
 */
Menu::make('adminNav', function ($menu) {

    $menu->add('Overview', 'admin/dashboard');
    $menu->add('Clients', 'admin/clients');
    $menu->add('Screen Groups', 'admin/screengroups');
    $menu->add('Screens', 'admin/screens');
    $menu->add('Images', 'admin/images');
    $menu->add('Calendar', 'admin/calendars');
    $menu->add('Events', 'admin/events');
    $menu->add('Event Metas', 'admin/eventmetas');
    $menu->add('Users', 'admin/users');
});
