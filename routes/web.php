<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Post;

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


$router->group(['prefix' => '/api', 'middleware' => 'jwtAuth'], function () use ($router)
{
    $router->group(['prefix' => '/user'], function () use ($router)
    {   
        $router->get('', 'UserController@index');
        $router->get('{id}', 'UserController@get');
        $router->post('store', 'UserController@store');
        $router->put('edit/{id}', 'UserController@update');
        $router->delete('delete/{id}', 'UserController@destroy');
        
    });
    
    $router->group(['prefix' => '/post'], function () use ($router)
    {   
        // main table: post
        $router->get('', 'PostController@index');
        $router->get('{id}', 'PostController@get');
        $router->post('store', 'PostController@store');
        $router->put('edit/{id}', 'PostController@update');
        $router->delete('delete/{id}', 'PostController@destroy');
        
        // relationship: comment
        $router->group(['prefix' => '/{post_id}'], function () use ($router)
        {
            $router->get('comment', 'PostController@getComments');
            $router->get('comment/{comment_id}', 'PostController@getComment');
            $router->post('store', 'PostController@postComment');
            $router->put('edit/{id}', 'PostController@editComment');
            $router->delete('delete/{id}', 'PostController@removeComment');
        });
    });
    
    $router->group(['prefix' => '/comment'], function () use ($router)
    {   
        $router->get('', 'CommentController@index');
        $router->get('{id}', 'CommentController@get');
        $router->post('store', 'CommentController@store');
        $router->put('edit/{id}', 'CommentController@update');
        $router->delete('delete/{id}', 'CommentController@destroy');
        
    });
    
    
});

$router->post('/api/login', 'TokenController@login');