<?php

use App\Admin\Controllers\AccountController;
use App\Admin\Controllers\LogController;
use App\Admin\Controllers\ParameterController;
use Encore\Admin\Facades\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('accounts', AccountController::class);
    $router->resource('parameters', ParameterController::class);
    $router->resource('logs', LogController::class);
});
