# Work with module create sitemap

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
    Softce\Slider\SliderServiceProvider::class,
]
```


**4.**
```php

//write to file modules\mage2\ecommerce\src\AdminMenu\Provider.php in group System


$sitemap = new AdminMenu();
$sitemap->key('sitemap')
    ->label('Сгенерировать SITEMAP')
    ->route('admin.sitemap.create')
    ->icon('fa-map');
$systemMenu->subMenu('sitemap',$sitemap);
```

