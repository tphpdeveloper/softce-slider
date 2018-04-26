<?php


Route::group([
    'namespace' => 'Softce\Slider\Http\Controllers',
    'prefix' => 'admin/slider',
    'middleware' => ['web']
    ],function(){

    Route::get('/', ['as' => 'admin.slider', 'uses' => 'SliderController@index']);

    

});