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
Route::group(['middleware' => ['auth']], function() {

    Route::get('/cart', 'HomeController@cart');
    Route::get('/notifications', 'HomeController@notifications');

    Route::get('/', 'HomeController@welcome');
    Route::get('/home', 'HomeController@index');

    Route::get('/providers', 'ProviderController@providerList');
    Route::get('/providers/{provider}', 'ProviderController@providerDetails')
        ->where('provider', '[0-9]+');
    Route::get('/providers/add', 'ProviderController@addProvider');
    Route::post('/providers', 'ProviderController@storeProvider');
    Route::get('/providers/{provider}/edit','ProviderController@editProvider');

    Route::get('/resources', 'ResourceController@resourceList');
    Route::get('/resources/add', 'ResourceController@addResource');
    Route::post('/resources/add', 'ResourceController@storeResource');
    Route::get('/resources/{resource}/edit','ResourceController@editResource');

    Route::get('/users', 'UserController@userList');
    Route::get('/users/{user}', 'UserController@userDetails')
        ->where('user', '[0-9]+');
    Route::get('/users/add', 'UserController@addUser');
    Route::post('/users/add','UserController@storeUser');
    Route::get('/users/{user}/edit', 'UserController@editUser');
    Route::post('/users/{user}/edit','UserController@updateUser');


    Route::get('/profile','ProfileController@viewProfile');
    Route::get('/profile/edit','ProfileController@editProfile');
    Route::post('/profile/edit','ProfileController@updateProfile');
    

});

Route::auth();

Route::get('/unauthorized', function () {
	$message = "You do not have permission to view this page.";
	return view('message', compact('message'));
} );
