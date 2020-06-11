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
/**
 * User routes
 */
$router->get('/users', 'UserController@showAllUsers');
$router->post('/users', 'UserController@registerUser');
$router->get('/users/{user}', 'UserController@showUser');
$router->put('/users/{user}', 'UserController@updateUser');
$router->patch('/users/{user}', 'UserController@updateUser');
$router->get('/users/search/{user}', 'UserController@searchForUser');
$router->delete('/users/{user}', 'UserController@destroyUser');


/**
 * Contact routes
 */
$router->get('/contacts', 'ContactController@showAllContacts');
$router->post('/contacts', 'ContactController@registerContact');
$router->get('/contacts/{user}', 'ContactController@showContact');
$router->put('/contacts/{user}', 'ContactController@updateContact');
$router->patch('/contacts/{user}', 'ContactController@updateContact');
$router->get('/contacts/{user}/search', 'ContactController@viewUserContacts');
$router->delete('/contacts/{user}', 'ContactController@destroyContact');
$router->get('/contacts/search/{user}', 'ContactController@searchForContact');


