<?php

use Illuminate\Support\Facades\Route;
use CloudCreativity\LaravelJsonApi\Facades\JsonApi;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api\V1\Auth')->prefix('api/v1')->middleware('json.api')->group(function () {
    Route::post('/login', 'LoginController');
    Route::post('/register', 'RegisterController');
    Route::post('/logout', 'LogoutController')->middleware('auth:api');
    Route::post('/password-forgot', 'ForgotPasswordController');
    Route::post('/password-reset', 'ResetPasswordController');
});

JsonApi::register('v1')->middleware('auth:api')->routes(function ($api) {
    $api->get('me', 'Api\V1\MeController@readProfile')->name('me.index');
    $api->patch('me', 'Api\V1\MeController@updateProfile')->name('me.patch');

    $api->resource('users');
});
Route::group(['prefix' => '/api/v1/customer'], function () {
    Route::get('/', 'Api\V1\CustomerController@index')->middleware('auth:api');
    Route::post('/{id}', 'Api\V1\CustomerController@getById')->middleware('auth:api');
    Route::post('/edit/{id}', 'Api\V1\CustomerController@update')->middleware('auth:api');
    Route::post('/delete/{id}', 'Api\V1\CustomerController@deleteById')->middleware('auth:api');
    Route::post('/create', 'Api\V1\CustomerController@create')->middleware('auth:api');
});
Route::group(['prefix' => '/api/v1/user'], function () {
    Route::get('/', 'Api\V1\UserController@index')->middleware('auth:api');
    Route::post('/{id}', 'Api\V1\UserController@getById')->middleware('auth:api');
    Route::post('/edit/{id}', 'Api\V1\UserController@update')->middleware('auth:api');
    Route::post('/delete/{id}', 'Api\V1\UserController@deleteById')->middleware('auth:api');

});
Route::group(['prefix' => '/api/v1/user-create'], function () {
    Route::post('/create', 'Api\V1\UserController@create')->name('user.create')->middleware('auth:api');
});
Route::group(['prefix' => '/api/v1/customer-create'], function () {
    Route::post('/create', 'Api\V1\CustomerController@create')->name('customer.create')->middleware('auth:api');
});
Route::group(['prefix' => '/api/v1/product'], function () {
    Route::get('/', 'Api\V1\ProductController@index')->middleware('auth:api');
    Route::post('/{id}', 'Api\V1\ProductController@getById')->middleware('auth:api');
    Route::post('/edit/{id}', 'Api\V1\ProductController@update')->middleware('auth:api');
    Route::post('/delete/{id}', 'Api\V1\ProductController@deleteById')->middleware('auth:api');
    Route::post('/create', 'Api\V1\ProductController@create')->middleware('auth:api');
    Route::get('/category', 'Api\V1\ProductController@getCategory')->middleware('auth:api');
    
});
