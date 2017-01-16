<?php

namespace Brainfab\LaravelForm\Facades;

use Illuminate\Support\Facades\Facade;

class FormFactory extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'form.factory';
    }
}
