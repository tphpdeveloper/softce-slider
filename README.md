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

    "sr-4": {
        ... ,

        "Softce\\Slider\\" : "vendor/softce/slider/"
    }
}
```


**2.**
```php
//in console write

composer update
```


**3.**
```php
//in service provider config/app

'providers' => [
    ... ,
    Softce\Slider\Providers\SliderServiceProvider::class,
]
```

**4.**
```php
//To work with slides, start the migration

php artisan migratre

```


**5.**
```php
//for show page slider, in code add next row

{{ route('admin.slider') }}

```


