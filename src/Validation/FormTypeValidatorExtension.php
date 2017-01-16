<?php

namespace Brainfab\LaravelForm\Validation;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Max Kovpak <max_kovpak@hotmail.com>
 */
class FormTypeValidatorExtension extends AbstractTypeExtension
{

    /**
     * @var FormValidatorInterface
     */
    protected $validator;

    /**
     * FormTypeValidatorExtension constructor.
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
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventSubscriber(new ValidationListener($this->validator));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'rules' => [],
            'csrf_protection' => true
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return FormType::class;
    }
}
