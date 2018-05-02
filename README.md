# Work with module slider

**1.**
```php
//write to composer.json
"require": {
    ...
    "softce/slider" : "dev-master"
}

"autoload": {
    ... ,

    "psr-4": {
        ... ,

        "Softce\\Slider\\" : "vendor/softce/slider/src"
    }
}
```


**2.**
```php
//in console write

composer update softce/slider
```


**3.**
```php
//in service provider config/app

'providers' => [
    ... ,
    Softce\Slider\Providers\SliderServiceProvider::class,
]


// in console 
php artisan config:cache
```

**4.**
```php
//To work with slides, start the migration

php artisan migrate

```


**5.**
```php
//for show page slider, in code add next row

{{ route('admin.slider.index') }}

```

# For delete module

```php
//delete next row

//in app.php
Softce\Slider\Providers\SliderServiceProvider::class,

//in composer.json
"Softce\\Slider\\": "vendor/softce/slider/src"

//in console
composer remove softce/slider

// delete -> bootstrap/config/cache.php

//in console
php artisan config:cache

```

