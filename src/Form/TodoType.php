<?php

namespace App\Form;

use App\Entity\Priority;
use App\Entity\Todo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TodoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('task', TextType::class, [
                'label' => 'Task',
                'required' => true
            ])
            //Add priority field as a select box with options from priority entity
            ->add('priority', EntityType::class, [
                'class' => Priority::class,
                'choice_label' => 'name',
                'placeholder' => 'Select a priority',
                'required' => true
            ])
            //Add submit button to the form with label "Save"
            ->add('save', SubmitType::class, [
                'label' => 'Save'
            ])
            ->add('id', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Todo::class,
        ]);
    }
}
