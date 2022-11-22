<?php


/** @var \Laravel\Lumen\Routing\Router $router */

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

//$router->middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//$router->group(['prefix' => 'user'], function () use ($router) {
//    $router->get('/version', function () use ($router) {
//        return $router->app->version();
//    });
//    $router->post('register',  'AuthController@register');
//    $router->post('sign-in', 'AuthController@signIn');
//    $router->post('/recover-password', 'AuthController@recoverPassword');
//});


//$router->group(['middleware' => 'auth.jwt'], function () use ($router) {
//    $router->get('/resumes', 'ResumeController@index');
//    $router->get('/resumes/{id}', 'ResumeController@show');
//    $router->post('/resumes/new/', 'ResumeController@store');
//    $router->put('/resumes/{id}', 'ResumeController@update');
//    $router->delete('/resumes/{id}', 'ResumeController@destroy');
//});
