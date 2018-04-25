<?php

namespace Softce\Slider\Providers;

use Illuminate\Support\ServiceProvider;
use Softce\Slider\Module\Slider ;


class SliderServiceProvider extends ServiceProvider
{

    public function boot(){
        $this->loadRoutesFrom(dirname(__DIR__).'\routes\web.php');
        $this->loadViewsFrom(dirname(__DIR__) . '\views', 'slider');
    }

    public function register(){
        //
    }

}