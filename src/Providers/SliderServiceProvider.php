<?php

namespace Softce\Slider\Providers;

use Illuminate\Support\ServiceProvider;
use Softce\Module\Slider;


class SliderServiceProvider extends ServiceProvider
{

    protected $defer = true;


    public function boot(){
        $this->loadRoutesFrom(dirname(__DIR__).'\routes\web.php');
        $this->loadViewsFrom(dirname(__DIR__) . '\views', 'slider');
    }

    public function register(){
        $this->app->bind('Softce\Slider', function ($app) {
            return new Slider();
        });
    }

    public function referrer(){

    }

}