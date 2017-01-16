<?php

namespace Brainfab\LaravelForm\Validation;

use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;

/**
 * @author Max Kovpak <max_kovpak@hotmail.com>
 */
class FormValidator implements FormValidatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function validate(FormInterface $form)
    {
        $errorBubbling = $form->getConfig()->getOption('error_bubbling', false);

        foreach ($form as $item) {
            /** @var FormInterface $item */
            $rules = $item->getConfig()->getOption('rules');

            if (null === $rules) {
                continue;
            }

            $name = $item->getName();
            $validator = \Validator::make([
                $name => $item->getNormData()
            ], [
                $name => $rules
            ], [], [
                $name => $item->getConfig()->getOption('label', $name)
            ]);

            if ($validator->fails()) {
                foreach ($validator->errors()->toArray() as $errors) {
                    foreach ($errors as $error) {
                        $formError = new FormError($error);
                        $item->addError($formError);

                        if ($errorBubbling) {
                            $item->getParent()->addError($formError);
                        }
                    }
                }
            }
        }
    }
}
