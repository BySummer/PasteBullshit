<?php

namespace App\UI\Controller\Paste\Create\Form;

use App\Application\Paste\PasteModel;
use App\UI\Controller\Paste\Create\Form\Dto\PasteDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class Form extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255]),
                ],
            ])
            ->add('content', TextareaType::class, [
                'required'    => false,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add(
                'visibility',
                ChoiceType::class,
                [
                    'choices'     => array_flip(PasteModel::getVisibilityNames()),
                    'required'    => true,
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            )
            ->add(
                'syntax',
                ChoiceType::class,
                [
                    'choices'     => array_flip(PasteModel::getSyntaxNames()),
                    'required'    => true,
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            )
            ->add(
                'lifetime',
                ChoiceType::class,
                [
                    'choices'     => array_flip(PasteModel::getLifetimeNames()),
                    'required'    => true,
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            )
            ->setDataMapper($this);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class'      => PasteDto::class,
                'empty_data'      => null,
                'csrf_protection' => false,
            ]
        );
    }

    public function mapDataToForms($viewData, \Traversable $forms): void
    {
        if ($viewData === null) {
            return;
        }

        if (!$viewData instanceof PasteDto) {
            throw new UnexpectedTypeException($viewData, PasteDto::class);
        }

        $forms = iterator_to_array($forms);

        $forms['name']->setData($viewData->getName());
        $forms['content']->setData($viewData->getContent());
        $forms['visibility']->setData($viewData->getVisibility());
        $forms['syntax']->setData($viewData->getSyntax());
        $forms['lifetime']->setData($viewData->getLifetime());
    }

    public function mapFormsToData(\Traversable $forms, &$viewData): void
    {
        $forms = iterator_to_array($forms);

        $viewData = new PasteDto(
            $forms['name']->getData(),
            $forms['content']->getData(),
            $forms['visibility']->getData(),
            $forms['syntax']->getData(),
            $forms['lifetime']->getData()
        );
    }
}