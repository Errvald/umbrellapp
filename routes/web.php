<?php

$app->group(['prefix' => 'api/1.0'], function () use ($app) {
    
    // Query
    $app->get('query', 'CityController@query');
    
    // Cities
    $app->get('cities', 'CityController@index');
    $app->get('cities/{id}', ['as' => 'city', 'uses' =>'CityController@show']);
    $app->post('cities', 'CityController@store');
    $app->put('cities/{id}', 'CityController@update');
    $app->delete('cities/{id}', 'CityController@destroy');

    // Weather
    $app->get('weather', 'WeatherController@index');
    $app->get('weather/{id}', ['as' => 'weather', 'uses' =>'WeatherController@show']);
    $app->post('weather', 'WeatherController@store');
    $app->put('weather/{id}', 'WeatherController@update');
    $app->delete('weather/{id}', 'WeatherController@destroy');

    // Favorites require authorization
    $app->group(['middleware' => 'jwt.auth'], function () use ($app) {
        $app->get('favorites', 'FavoriteController@index');
        // Used for both storing and restoring.
        $app->post('favorites/{id}', 'FavoriteController@store');
        $app->delete('favorites/{id}', 'FavoriteController@destroy');
    });

    // Auth
    $app->POST('auth/login', 'AuthController@loginPost');

});

$app->get('/', function () use ($app) {
    return $app->version();
});