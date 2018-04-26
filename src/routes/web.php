<?php


Route::group([
    'namespace' => 'Softce\Slider\Http\Controllers',
    'prefix' => 'admin/',
    'middleware' => ['web']
    ],function(){

//    Route::get('/', ['as' => 'admin.slider', 'uses' => 'SliderController@index']);
//    Route::post('/create', ['as' => 'admin.slider.create', 'uses' => 'SliderController@create']);
//    Route::post('/edit', ['as' => 'admin.slider.edit', 'uses' => 'SliderController@create']);
//    Route::post('/delete', ['as' => 'admin.slider.edit', 'uses' => 'SliderController@create']);

    Route::resource( '/slider', 'SliderController', [ 'as' => 'admin', 'only' => ['index', 'store', 'update', 'destroy'] ] );

});