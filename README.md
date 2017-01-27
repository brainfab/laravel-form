Use [Symfony Form](http://symfony.com/doc/current/components/form.html) component with Laravel framework
=====================================

[![Latest Stable Version](https://poser.pugx.org/brainfab/laravel-form/v/stable)](https://packagist.org/packages/brainfab/laravel-form) [![Total Downloads](https://poser.pugx.org/brainfab/laravel-form/downloads)](https://packagist.org/packages/brainfab/laravel-form) [![Latest Unstable Version](https://poser.pugx.org/brainfab/laravel-form/v/unstable)](https://packagist.org/packages/brainfab/laravel-form) [![License](https://poser.pugx.org/brainfab/laravel-form/license)](https://packagist.org/packages/brainfab/laravel-form) [![Code Climate](https://codeclimate.com/github/brainfab/laravel-form/badges/gpa.svg)](https://codeclimate.com/github/brainfab/laravel-form)

Under construction

Installation
------------

Require this package with composer:

`` composer require brainfab/laravel-form ``

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

Usage example
-------------
app/Forms/UserForm.php
```php
<?php

namespace App\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [
            'rules' => 'required|min:6',
            'label' => 'Name'
        ]);

        $builder->add('email', EmailType::class, [
            'rules' => 'required|email',
            'label' => 'Email'
        ]);

        $builder->add('save_btn', SubmitType::class, [
            'label' => 'Save'
        ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        //set default options
        $resolver->setDefaults([]);
    }
}
```

app/Http/Controllers/UserController.php

```php
<?php

namespace App\Http\Controllers;

use App\Forms\UserForm;
use Brainfab\LaravelForm\Controller\LaravelForm;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use LaravelForm;

    public function index(Request $request)
    {
        $user = new User();

        $form = $this->createForm(TestForm::class, $user);

        if ($request->isMethod('post')) {
            //submit request
            $form->handleRequest($request);

            if ($form->isValid()) {
                $user->save();
            }
        }

        return view('users', [
            'form' => $form->createView()
        ]);
    }
}
```

resources/views/users.blade.php
```php
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LaravelForm</title>
</head>
<body>

    {{form($form)}}

</body>
</html>
```
