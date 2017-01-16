<?php

namespace Brainfab\LaravelForm\Validation;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

/**
 * @author Max Kovpak <max_kovpak@hotmail.com>
 */
class ValidationListener implements EventSubscriberInterface
{

    /**
     * @var FormValidatorInterface
     */
    protected $validator;

    /**
     * ValidationListener constructor.
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
    public static function getSubscribedEvents()
    {
        return array(FormEvents::POST_SUBMIT => 'validateForm');
    }

    /**
     * Validates the form and its domain object.
     *
     * @param FormEvent $event The event object
     */
    public function validateForm(FormEvent $event)
    {
        $form = $event->getForm();

        if ($form->isRoot()) {
            $this->validator->validate($form);
        }
    }
}
