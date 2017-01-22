<?php

namespace Brainfab\LaravelForm\Blade;

use Illuminate\Support\HtmlString;
use Illuminate\View\View;
use Symfony\Component\Form\AbstractRendererEngine;
use Symfony\Component\Form\FormView;

/**
 * @author Max Kovpak <max_kovpak@hotmail.com>
 */
class FormCompiler
{
    /**
     * @var View
     */
    protected $layoutView;

    /**
     * @var string
     */
    protected $theme;

    /**
     * FormCompiler constructor.
     *
     * @param string $themeLayoutView
     */
    public function __construct($themeLayoutView)
    {
        $this->setTheme($themeLayoutView);
    }

    /**
     * @param string $themeLayoutView
     */
    protected function setTheme($themeLayoutView)
    {
        $this->layoutView = \View::make('form::form_' . $themeLayoutView . '_layout');
        //precompile layout blocks
        $this->layoutView->render();
    }

    /**
     * @param FormView $form
     * @param array    $variables
     *
     * @return HtmlString
     */
    public function compileFormWidget(FormView $form, $variables = [])
    {
        $cacheKey = $form->vars[AbstractRendererEngine::CACHE_KEY_VAR];
        $variables['widget'] = str_replace('_', '', substr($cacheKey, strlen($form->vars['name']) + 1));

        return $this->render('form::form_widgets', $form->vars, $variables);
    }

    /**
     * @param FormView $form
     *
     * @return HtmlString
     */
    public function compileFormErrors(FormView $form)
    {
        return $this->render('form::form_errors', $form->vars);
    }

    /**
     * @param FormView $form
     * @param null     $label
     * @param array    $variables
     *
     * @return HtmlString
     */
    public function compileFormLabel(FormView $form, $label = null, array $variables)
    {
        if (null !== $label) {
            $variables['label'] = $label;
        }

        return $this->render('form::form_label', $form->vars, $variables);
    }

    /**
     * @param FormView $form
     *
     * @return HtmlString
     */
    public function compileFormRow(FormView $form)
    {
        $form->setRendered();
        return $this->render('form::form_row', $form->vars);
    }

    /**
     * @param FormView $form
     *
     * @return HtmlString
     */
    public function compileFormRest(FormView $form)
    {
        return $this->render('form::form_rest', $form->vars);
    }

    /**
     * @param FormView $form
     * @param array    $variables
     *
     * @return HtmlString
     */
    public function compileForm(FormView $form, array $variables = [])
    {
        $form->setRendered();
        return $this->render('form::form', $form->vars, $variables);
    }

    /**
     * @param FormView $form
     * @param array    $variables
     *
     * @return HtmlString
     */
    public function compileFormStart(FormView $form, $variables = [])
    {
        return $this->render('form::form_start', $form->vars, $variables);
    }

    /**
     * @param FormView $form
     * @param array    $options
     *
     * @return HtmlString
     */
    public function compileFormEnd(FormView $form, array $options = [])
    {
        return $this->render('form::form_end', $form->vars, $options);
    }

    /**
     * @param string $view
     * @param array  $data
     * @param array  $mergeData
     *
     * @return HtmlString
     * @deprecated
     */
    protected function render($view, $data = [], $mergeData = [])
    {
        return new HtmlString(\View::make($view, array_merge($data, $mergeData))->render());
    }

    /**
     * Render layout block.
     *
     * @param string $name
     * @param array  $data
     * @param array  $mergeData
     */
    protected function renderBlock($name, array $data = [], array $mergeData = [])
    {
        new HtmlString(app('form.block_compiler')->render($name, array_merge($data, $mergeData)));
    }
}
