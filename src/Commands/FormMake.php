<?php

namespace Brainfab\LaravelForm\Commands;

use Illuminate\Console\GeneratorCommand;

/**
 * @author Max Kovpak <max_kovpak@hotmail.com>
 */
class FormMake extends GeneratorCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:form';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new form class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Form';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/form.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }
}
