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

Route::get('sitemap.xml', 'SitemapController@sitemap');



Route::get('/', 'HomeController@getIndex');


// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');
Route::get('confirm/{token}', 'Auth\AuthController@getConfirm');

// Resend routes...
Route::get('resend', 'Auth\AuthController@getResend');

// Registration routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

/*
*
*   Administration
*
*/

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    
    Route::get('/', 'AdminController@index');

    Route::get('/mail', 'AdminController@mail');

    Route::get('/info', 'AdminController@getInfo');
    Route::post('/info', 'AdminController@postInfo');

    

    
    Route::get('/pages', 'AdminController@getPages');


    Route::get('/page/delete/{id?}', 'AdminController@deletePageById');
    Route::get('/page/{id?}', 'AdminController@getPageById');
    Route::post('/page/{id?}', 'AdminController@postPageById');





    Route::get('filemanager/upload', function() {
                return view('auth.file_manager._image-dialog');
            });
    Route::post('filemanager/upload', 'FileManagerController@imageUpload');
    
});


/*
*
*  Super Administration
*
*/

Route::group(['prefix' => 'super-admin', 'middleware' => 'auth.super'], function () {
    
    Route::get('/', 'SuperAdminController@index');
    
});
