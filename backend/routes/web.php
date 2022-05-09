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

// --------- VIDEOGAMES ---------

$router->get(
    'videogames',
    [
        'as' => 'videogame-list',
        'uses' => 'VideogameController@list'
    ]
);

$router->post(
    'videogames',
    [
        'as' => 'videogame-add',
        'uses' => 'VideogameController@add'
    ]
);

$router->get(
    'videogames/{id}',
    [
        'as' => 'videogame-read',
        'uses' => 'VideogameController@read'
    ]
);

$router->put(
    'videogames/{id}',
    [
        'as' => 'videogame-update',
        'uses' => 'VideogameController@update'
    ]
);

$router->delete(
    'videogames/{id}',
    [
        'as' => 'videogame-delete',
        'uses' => 'VideogameController@delete'
    ]
);

$router->get(
    'videogames/{id}/reviews',
    [
        'as' => 'videogame-getreviews',
        'uses' => 'VideogameController@getReviews'
    ]
);



// --------- PLATFORMS ---------

$router->get(
    'platforms',
    [
        'as' => 'platform-list',
        'uses' => 'PlatformController@list'
    ]
);

$router->post(
    'platforms',
    [
        'as' => 'platform-add',
        'uses' => 'PlatformController@add'
    ]
);

$router->get(
    'platforms/{id}',
    [
        'as' => 'platform-read',
        'uses' => 'PlatformController@read'
    ]
);

$router->put(
    'platforms/{id}',
    [
        'as' => 'platform-update',
        'uses' => 'PlatformController@update'
    ]
);

$router->delete(
    'platforms/{id}',
    [
        'as' => 'platform-delete',
        'uses' => 'PlatformController@delete'
    ]
);


// --------- REVIEWS ---------

$router->get(
    'reviews',
    [
        'as' => 'review-list',
        'uses' => 'ReviewController@list'
    ]
);

$router->post(
    'reviews',
    [
        'as' => 'review-add',
        'uses' => 'ReviewController@add'
    ]
);

$router->get(
    'reviews/{id}',
    [
        'as' => 'review-read',
        'uses' => 'ReviewController@read'
    ]
);

$router->put(
    'reviews/{id}',
    [
        'as' => 'review-update',
        'uses' => 'ReviewController@update'
    ]
);

$router->delete(
    'reviews/{id}',
    [
        'as' => 'review-delete',
        'uses' => 'ReviewController@delete'
    ]
);
