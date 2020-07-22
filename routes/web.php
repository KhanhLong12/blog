<?php

use Illuminate\Support\Facades\Route;

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
$prefixAdmin = config('zvn.url.prefix_admin');//vào file config trỏ đến zvn->url->prefix_admin
$prefixNews = config('zvn.url.prefix_news');//vào file config trỏ đến zvn->url->prefix_news

Route::get('/', function () {
    return view('welcome');
});

// Route::prefix($prefixAdmin)->group(function () {
//     Route::get('users', function () {
//         return 'admin/users';
//     });
//     Route::get('categories', function () {
//         return 'admin/categories';
//     });
// });

Route::group(['prefixAdmin' => $prefixAdmin],function() use($prefixAdmin){
    Route::get('', 'DashboardController@index');
	Route::get('user', function () {
        return 'admin/user';
    });
    //=================== dashboard =====================
    $prefix = 'dashboard';
    $controllerName = 'dashboard';
    Route::group(['prefix' => $prefix], function() use($controllerName) {
    	$controller = ucfirst($controllerName) . 'Controller@'; //lưu DashboardController@ vào $controller
	    Route::get('/', ['as' => $controllerName, 'uses' => $controller . 'index']);
	   });
	//=================== slider ========================
    $prefix = 'slider';
    $controllerName = 'slider';
    Route::group(['prefix' => $prefix], function() use($controllerName) {
    	$controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/',                             ['as' => $controllerName,               'uses'            => $controller . 'index']);
        Route::get('form/{id?}',                    ['as' => $controllerName .'/form',      'uses'   => $controller . 'form'])->where('id','[0-9]+');
        Route::post('save',                         ['as' => $controllerName .'/save',      'uses'   => $controller . 'save']);
        Route::get('delete/{id}',                   ['as' => $controllerName. '/delete',    'uses' => $controller . 'delete'])->where('id','[0-9]+');
        Route::get('change-status-{status}/{id}',   ['as' => $controllerName.'/status',     'uses'  => $controller . 'status'])->where('id','[0-9]+');
    });

    //=================== category ========================
    $prefix = 'category';
    $controllerName = 'category';
    Route::group(['prefix' => $prefix], function() use($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/',                             ['as' => $controllerName,               'uses'            => $controller . 'index']);
        Route::get('form/{id?}',                    ['as' => $controllerName .'/form',      'uses'   => $controller . 'form'])->where('id','[0-9]+');
        Route::post('save',                         ['as' => $controllerName .'/save',      'uses'   => $controller . 'save']);
        Route::get('delete/{id}',                   ['as' => $controllerName. '/delete',    'uses'   => $controller . 'delete'])->where('id','[0-9]+');
        Route::get('change-status-{status}/{id}',   ['as' => $controllerName.'/status',     'uses'   => $controller . 'status'])->where('id','[0-9]+');
        Route::get('change-isHome-{isHome}/{id}',   ['as' => $controllerName.'/isHome',     'uses'   => $controller . 'isHome'])->where('id','[0-9]+');
        Route::get('change-display-{display}/{id}', ['as' => $controllerName.'/display',   'uses'   => $controller . 'changeDisplay'])->where('id','[0-9]+');
    });

    //=================== article ========================
    $prefix = 'article';
    $controllerName = 'article';
    Route::group(['prefix' => $prefix], function() use($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/',                             ['as' => $controllerName,               'uses'            => $controller . 'index']);
        Route::get('form/{id?}',                    ['as' => $controllerName .'/form',      'uses'   => $controller . 'form'])->where('id','[0-9]+');
        Route::post('save',                         ['as' => $controllerName .'/save',      'uses'   => $controller . 'save']);
        Route::get('delete/{id}',                   ['as' => $controllerName. '/delete',    'uses'   => $controller . 'delete'])->where('id','[0-9]+');
        Route::get('change-status-{status}/{id}',   ['as' => $controllerName.'/status',     'uses'   => $controller . 'status'])->where('id','[0-9]+');
    });
});

Route::group(['prefixNews' => $prefixNews],function() use($prefixNews){
    //=================== news ========================
    $prefix = 'news';
    $controllerName = 'news';
    Route::group(['prefix' => $prefix], function() use($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/',                             ['as' => $controllerName,'uses'            => $controller . 'index']);
    });
});