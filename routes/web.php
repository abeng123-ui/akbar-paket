<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'package'], function () use ($router) {
    $router->get('', 'PackageController@list');
    $router->get('{transaction_id}', 'PackageController@listByTransactionId');
    $router->post('', 'PackageController@create');
    $router->put('{transaction_id}', 'PackageController@updateAll');
    $router->delete('{transaction_id}', 'PackageController@delete');
});
