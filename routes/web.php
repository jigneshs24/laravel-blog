<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::group(['namespace' => 'Auth'], function () {
//
//    Route::match(['get', 'post'], 'register', 'RegisterController@register')->name('register');
//    Route::match(['get', 'post'], 'login', 'LoginController@login')->name('login');
//    Route::get('logout', 'LoginController@logout')->name('logout');
//
//});

Route::group(['namespace' => 'Admin'], function () {
    Route::match(['get', 'post'], 'login', 'LoginController@login')->name('login');
    Route::get('logout', 'LoginController@logout')->name('logout');

    // Protect admin routes with the 'admin.auth' middleware
    Route::group(['prefix' => 'admin', 'middleware' => 'admin.auth'], function () {
        Route::get('dashboard', 'DashboardController@index')->name('admin-dashboard');
    });

    Route::group(['prefix' => 'blog'], function () {

        Route::group(['prefix' => 'category'], function () {

            Route::get('/', 'BlogCategoryController@index')->name('admin-blog-category-view');
            Route::post('/', 'BlogCategoryController@store')->name('admin-blog-category-view');
            Route::delete('/admin/categories/{id}', 'BlogCategoryController@destroy')->name('admin-blog-category-delete');
//            Route::get('update/{id}', 'BlogCategoryController@update')->name('admin-blog-category-update');
//            Route::post('update/{id}', 'BlogCategoryController@update')->name('admin-blog-category-update');

        });

        Route::get('/', 'BlogController@index')->name('admin-blog-view');

        Route::get('create', 'BlogController@create')->name('admin-blog-create');
        Route::post('create', 'BlogController@create')->name('admin-blog-create');

        Route::get('update/{id}', 'BlogController@update')->name('admin-blog-update');
        Route::post('update/{id}', 'BlogController@update')->name('admin-blog-update');

    });
});
