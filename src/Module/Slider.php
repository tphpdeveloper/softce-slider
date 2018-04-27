<?php

namespace Softce\Slider\Module;


use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use \Themsaid\Multilingual\Translatable;

    protected $fillable = ['path', 'text'];
    public $translatable = ['text'];
    public $casts = [
        'text' => 'array'
    ];
}