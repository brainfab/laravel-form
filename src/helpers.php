<?php

use Symfony\Component\Form\FormView;

if (!function_exists('form_widget')) {
    /**
     * Render form field.
     *
     * @param FormView $form
     * @param array    $variables
     *
     * @return \Illuminate\Support\HtmlString
     */
    function form_widget(FormView $form, $variables = [])
    {
        return app('form.view_compiler')->compileFormWidget($form, $variables);
    }
}

if (!function_exists('form_errors')) {
    /**
     * Render form errors.
     *
     * @param FormView $form
     *
     * @return \Illuminate\Support\HtmlString
     */
    function form_errors(FormView $form)
    {
        return app('form.view_compiler')->compileFormErrors($form);
    }
}

if (!function_exists('form_label')) {
    /**
     * Render form label.
     *
     * @param FormView $form
     * @param null     $label
     * @param array    $variables
     *
     * @return \Illuminate\Support\HtmlString
     */
    function form_label(FormView $form, $label = null, $variables = [])
    {
        return app('form.view_compiler')->compileFormLabel($form, $label, $variables);
    }
}

if (!function_exists('form_row')) {
    /**
     * Render form row.
     *
     * @param FormView $form
     *
     * @return \Illuminate\Support\HtmlString
     */
    function form_row(FormView $form)
    {
        return app('form.view_compiler')->compileFormRow($form);
    }
}

if (!function_exists('form_rest')) {
    /**
     * Render rest of the form that is not already rendered.
     *
     * @param FormView $form
     *
     * @return \Illuminate\Support\HtmlString
     */
    function form_rest(FormView $form)
    {
        return app('form.view_compiler')->compileFormRest($form);
    }
}

if (!function_exists('form')) {
    /**
     * Render full form.
     *
     * @param FormView $form
     * @param array    $variables
     *
     * @return \Illuminate\Support\HtmlString
     */
    function form(FormView $form, array $variables = [])
    {
        return app('form.view_compiler')->compileForm($form, $variables);
    }
}

if (!function_exists('form_start')) {
    /**
     * Render form open tag.
     *
     * @param FormView $form
     * @param array    $variables
     *
     * @return \Illuminate\Support\HtmlString
     */
    function form_start(FormView $form, $variables = [])
    {
        return app('form.view_compiler')->compileFormStart($form, $variables);
    }
}

if (!function_exists('form_end')) {
    /**
     * Render form close tag.
     *
     * @param FormView $form
     * @param array    $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    function form_end(FormView $form, array $options = [])
    {
        return app('form.view_compiler')->compileFormEnd($form, $options);
    }
}
