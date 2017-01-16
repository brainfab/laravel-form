<?php

namespace Brainfab\LaravelForm\Controller;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormTypeInterface;

/**
 * @author Max Kovpak <max_kovpak@hotmail.com>
 */
trait LaravelForm
{
    /**
     * Creates and returns a Form instance from the type of the form.
     *
     * @param string|FormTypeInterface $type    The built type of the form
     * @param mixed                    $data    The initial data for the form
     * @param array                    $options Options for the form
     *
     * @return Form
     */
    public function createForm($type, $data = null, array $options = [])
    {
        return app('form.factory')
            ->createNamedBuilder(null, $type, $data, $options)
            ->getForm();
    }

    /**
     * Creates and returns a form builder instance.
     *
     * @param mixed $data    The initial data for the form
     * @param array $options Options for the form
     *
     * @return FormBuilder
     */
    public function createFormBuilder($data = null, array $options = [])
    {
        return app('form.factory')->createBuilder('form', $data, $options);
    }

    /**
     * Creates and returns a named form builder instance.
     *
     * @param string|null $name    Form builder name.
     * @param mixed       $data    The initial data for the form
     * @param array       $options Options for the form
     *
     * @return FormBuilder
     */
    public function createNamedFormBuilder(
        $name = null,
        $data = null,
        array $options = []
    ) {
        return app('form.factory')
            ->createNamedBuilder($name, 'form', $data, $options);
    }
}
