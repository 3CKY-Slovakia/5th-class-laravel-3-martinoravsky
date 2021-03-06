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

/**
 * HOME
 */
Route::get('/', function () {
    return view('welcome', [
        'articles' => \App\Article::orderBy('created_at', 'desc')->get()
    ]);
});
Route::get('home', function () {
    return view('welcome', [
        'articles' => \App\Article::orderBy('created_at', 'desc')->get()
    ]);
});


/**
 * BLOG
 */
Route::group(['prefix' => 'blog-post'], function () {
    Route::get('/{id}', function () {
        return view('blog-post');
    });
});

/**
 * AUTH
 */
Route::group(['prefix' => 'auth'], function () {
    // Authentication routes...
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');

    // Registration routes...
    Route::get('register', 'Auth\AuthController@getRegister');
    Route::post('register', 'Auth\AuthController@postRegister');

    // Password reset link request routes...
    Route::get('/{id}', function(){ return view('auth/password'); });
    Route::get('password/email', 'Auth\PasswordController@getEmail');
    Route::post('password/email', 'Auth\PasswordController@postEmail');

    // Password reset routes...
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');
});

/**
 * ARTICLES
 */
Route::group(['prefix' => 'article'], function () {
    Route::get('/', 'ArticlesController@index');
    Route::get('show/{id}', 'ArticlesController@show');
    Route::get('delete/{id}', 'ArticlesController@destroy');
    Route::get('edit/{id}', 'ArticlesController@edit');
    Route::get('publish/{id}', 'ArticlesController@publish');

    /**
     * SHOW UNPUBLISHED ARTICLES WHEN ADMIN
     */
    Route::group(['middleware' => ['unpublished']], function() {
        Route::get('unpublished', function () {
            return view('articles/unpublished', [
                'articles' => \App\Article::orderBy('created_at', 'desc')->get()
            ]);
        });
    });

    Route::group(['middleware' => ['number']], function() {
        Route::get('create','ArticlesController@create');
    });
   // Route::get('create','ArticlesController@create');
    Route::post('store','ArticlesController@store');

    Route::post('update/{id}', 'ArticlesController@update');
});

/**
 * USER PROFILE
 */

Route::get('user/profile','UserController@profile');

/**
 * LIMIT OF TWO ARTICLES REACHED
 */
Route::get('articles/limitreached','UserController@limitReached');

/**
 * SHOW BLOGGERS
 */
Route::get('user/bloggers','UserController@showBloggers');



