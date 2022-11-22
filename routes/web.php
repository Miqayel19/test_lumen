<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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


$router->group(['prefix' => 'api/user/'], function () use ($router) {
    $router->post('register',  'AuthController@register');
    $router->post('sign-in', 'AuthController@signIn');
    $router->post('recover-password-link', 'AuthController@sendRecoverPasswordLink');
    $router->post('recover-password', 'AuthController@recoverPassword');
    $router->get('home', 'AuthController@dashboard');
    $router->get('companies', 'CompanyController@getCompanies');
    $router->post('companies', 'CompanyController@createCompany');
    $router->get('reset-password',  [
        'as' => 'reset.password', 'uses' => 'AuthController@resetPassword'
    ]);
});
