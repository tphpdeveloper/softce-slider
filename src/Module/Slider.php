<?php

namespace Softce\Slider\Module;


use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['path', 'text'];
}