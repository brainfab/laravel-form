Use [Symfony Form](http://symfony.com/doc/current/components/form.html) component with Laravel framework
=====================================

Under construction

Installation
------------

Require this package with composer:

`` composer require brainfab/laravel-dashboard ``

After updating composer, add the ServiceProvider to the providers array in config/app.php

`` Brainfab\LaravelForm\LaravelFormsServiceProvider::class, ``

Add the Facade to the aliases array in config/app.php

`` 'FormFactory' => Brainfab\LaravelForm\Facades\FormFactory::class, ``

(optional) Copy the package config to your local config with the publish command:

`` php artisan vendor:publish --tag=config  ``

(optional) Copy the package views to your local views/vendor folder with the publish command:

`` php artisan vendor:publish --tag=views  ``

Console
-------

Generate form class:
`` php artisan make:form 'App\Forms\UserForm' ``