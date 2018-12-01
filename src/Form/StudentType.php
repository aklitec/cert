<?php

namespace App\Form;

use App\Entity\Student;
use App\Entity\StudyLevel;
use App\Repository\StudyLevelRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
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
//            ->add('studyLevel', EntityType::class, [
//                'class' => StudyLevel::class,
//                'query_builder' => function (StudyLevelRepository $er) {return $er->select();}
//            ])

            ->add('studyLevel', ChoiceType::class, array(
                     'choices'=>array(

                        'النظام الجديد'=>array(
                            'الأولى إعدادي'=>'الأولى إعدادي',
                            'الثانية إعدادي'=>'الثانية إعدادي',
                            'الثالثة إعدادي'=>'الثالثة إعدادي',
                            'الرابعة إعدادي'=>'الرابعة إعدادي',
                            'الجذع المشترك'=>'الجذع المشترك',
                            'الأولى باكالوريا'=>'الأولى باكالوريا',
                            'الثانية باكالوريا'=>'الثانية باكالوريا',


                        ),
                        'النظام القديم'=>array(
                            'السادس أساسي'=>'السادس أساسي',
                            'السابعة إعدادي'=>'السابعة إعدادي',
                            'الثامنة إعدادي'=>'الثامنة إعدادي',
                            'التاسعة إعدادي'=>'التاسعة إعدادي',
                            'الأولى ثانوي'=>'الأولى ثانوي',
                            'الثانية ثانوي'=>'الثانية ثانوي',
                            'الثالثة ثانوي'=>'الثالثة ثانوي',

                        ),
                    ),

            ))
            ->add('branch', ChoiceType::class,
                Array (
                    'placeholder' => 'Choose a branch',
                    'choices'=>array(
                        'النظام الجديد للجذع مشترك'=>array(
                            'العلمي'=>'العلمي',
                            'آداب وعلوم إنسانية'=>'آداب وعلوم إنسانية',
                        ),
                        'النظام الجديد'=>array(
                            'علوم تجريبية'=>'علوم تجريبية',
                            'علوم الحياة والأرض'=>'علوم الحياة والأرض',
                            'علوم فزيائية'=>'علوم فزيائية',
                            'علوم إنسانية'=>'علوم إنسانية',
                            'آداب'=>'آداب',
                        ),
                        'النظام القديم'=>array(
                            'علوم تجريبية'=>'علوم تجريبية',
                            'آداب عصرية'=>'آداب عصرية'
                        ),

                    ),
                    'required'=>false
                ))

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
