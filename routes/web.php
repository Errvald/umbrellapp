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

});

$app->get('/', function () use ($app) {
    return $app->version();
});