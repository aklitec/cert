<?php

namespace App\Form;

use App\Entity\Student;
use App\Entity\StudyLevel;
use App\Repository\StudyLevelRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class)
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('cne', TextType::class)
            ->add('birthPlace', TextType::class)
            ->add('birthDate', DateType::class, [
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => [
                    'class' => 'datetimepicker',
                    'placeholder' => 'dd/MM/yyyy',
                ]
            ])
            ->add('stopDate', DateType::class, [
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => [
                    'class' => 'datetimepicker',
                    'placeholder' => 'dd/MM/yyyy',
                ]
            ])
            ->add('studyLevel', EntityType::class, [
                'class' => StudyLevel::class,
                'query_builder' => function (StudyLevelRepository $er) {return $er->select();}
            ])
            ->add('comments', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
            'translation_domain' => 'student'
        ]);
    }
}
