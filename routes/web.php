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
        $router->get('', ['as' => 'user.getAll', 'uses' => 'UserController@index']);
        $router->get('{id}', ['as' => 'user.get', 'uses' => 'UserController@get']);
        $router->post('store', 'UserController@store');
        $router->put('edit/{id}', ['as' => 'user.edit', 'uses' => 'UserController@update']);
        $router->delete('delete/{id}', ['as' => 'user.delete', 'uses' => 'UserController@destroy']);
        
    });
    
    $router->group(['prefix' => '/post'], function () use ($router)
    {   
        // main table: post
        $router->get('', ['as' => 'post.getAll', 'uses' => 'PostController@index']);
        $router->get('{id}', ['as' => 'post.get', 'uses' => 'PostController@get']);
        $router->post('store', ['as' => 'post.store', 'uses' => 'PostController@store']);
        $router->put('edit/{id}', ['as' => 'post.edit', 'uses' => 'PostController@update']);
        $router->delete('delete/{id}', ['as' => 'post.delete', 'uses' => 'PostController@destroy']);
         
        // relationship: comment
        $router->group(['prefix' => '/{post_id}'], function () use ($router)
        {
            $router->get('comment', ['as' => 'post.comment.getAll', 'uses' => 'PostController@getComments']);
            // $router->get('comment/{comment_id}', ['as' => 'post.comment.get', 'uses' => 'PostController@getComment']);
            // $router->post('store', ['as' => 'post.comment.store', 'uses' => 'PostController@postComment']);
            // $router->put('edit/{id}', ['as' => 'post.comment.edit', 'uses' => 'PostController@editComment']);
            // $router->delete('delete/{id}', ['as' => 'post.comment.delete', 'uses' => 'PostController@removeComment']);
        });
    });
    
    $router->group(['prefix' => '/comment'], function () use ($router)
    {   
        $router->get('', ['as' => 'comment.getAll', 'uses' => 'CommentController@index']);
        $router->get('{id}', ['as' => 'comment.get', 'uses' => 'CommentController@get']);
        $router->post('store', ['as' => 'comment.store', 'uses' => 'CommentController@store']);
        $router->put('edit/{id}', ['as' => 'comment.edit', 'uses' => 'CommentController@update']);
        $router->delete('delete/{id}', ['as' => 'comment.delete', 'uses' => 'CommentController@destroy']);
        
    });
    
    
});

$router->post('/api/login', 'TokenController@login');