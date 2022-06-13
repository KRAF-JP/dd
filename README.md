# krafjp/dd

## Installation
1. composer 
```shell
compoer require --dev krafjp/dd
```
2. register laravel app
``` php
    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
 
        // add database definition provider
        Krafjp\Dd\DdServiceProvider::class,
    ];
```
3. init command
```shell
php artisan db:dd
```

4. generate doc
```shell
php artisan db:dd-gen
```
