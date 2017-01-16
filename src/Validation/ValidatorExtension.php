<?php

namespace Brainfab\LaravelForm\Validation;

use Symfony\Component\Form\AbstractExtension;

/**
 * @author Max Kovpak <max_kovpak@hotmail.com>
 */
class ValidatorExtension extends AbstractExtension
{
    /**
     * @var FormValidatorInterface
     * */
    private $validator;

    /**
     * ValidatorExtension constructor.
     *
     * @param FormValidatorInterface $formValidator
     */
    public function __construct(FormValidatorInterface $formValidator)
    {
        $this->validator = $formValidator;
    }

    /**
     * {@inheritdoc}
     */
    protected function loadTypeExtensions()
    {
        return array(
            new FormTypeValidatorExtension($this->validator),
        );
    }
}
