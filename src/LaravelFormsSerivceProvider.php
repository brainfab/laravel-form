<?php

namespace Brainfab\LaravelForm;

use Brainfab\LaravelForm\Blade\FormCompiler;
use Brainfab\LaravelForm\Commands\FormMake;
use Brainfab\LaravelForm\Validation\FormValidator;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Brainfab\LaravelForm\Validation\ValidatorExtension as LaravelFormValidatorExtension;

/**
 * @author Max Kovpak <max_kovpak@hotmail.com>
 */
class LaravelFormsSerivceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton('form.view_compiler', function () {
            return new FormCompiler();
        });

        $this->app->singleton('form.factory', function () {
            $formValidator = new FormValidator();

            return Forms::createFormFactoryBuilder()
                ->addExtension(new HttpFoundationExtension())
                ->addExtension(new LaravelFormValidatorExtension($formValidator))
                ->getFormFactory();
        });

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'forms');

        require_once __DIR__ . '/helpers.php';
    }

    public function register()
    {
        $this->commands([
            FormMake::class,
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['form.factory', 'form.view_compiler'];
    }
}
