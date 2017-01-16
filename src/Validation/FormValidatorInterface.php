<?php

namespace Brainfab\LaravelForm\Validation;

use Symfony\Component\Form\FormInterface;

/**
 * @author Max Kovpak <max_kovpak@hotmail.com>
 */
interface FormValidatorInterface
{
    /**
     * Validate submitted form.
     *
     * @param FormInterface $form
     *
     * @return void
     */
    public function validate(FormInterface $form);
}
