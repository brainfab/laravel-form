<?php

namespace Brainfab\LaravelForm;

use Brainfab\LaravelForm\Blade\BlockCompiler;
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
class LaravelFormsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton('form.view_compiler', function () {
            return new FormCompiler();
        });

        $this->app->singleton('form.block_compiler', function () {
            return new BlockCompiler();
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

        $this->bootBladeDirectives();
    }

    /**
     * Boot Blade Directives.
     */
    protected function bootBladeDirectives()
    {
        //start block
        \Blade::directive('block', function ($expression) {
            return "<?php app('form.block_compiler')->addBlock($expression, function (\$__data) { extract(\$__data); ?>";
        });

        //end block
        \Blade::directive('endblock', function () {
            return '<?php }); ?>';
        });

        //yield block
        \Blade::directive('yieldblock', function ($expression) {
            return "<?php app('form.block_compiler')->yieldBlock($expression, \$__data); ?>";
        });
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
        return ['form.factory', 'form.view_compiler', 'form.view_compiler'];
    }
}
