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
            /*->add('studyLevel', EntityType::class, [
                'class' => StudyLevel::class,
                'query_builder' => function (StudyLevelRepository $er) {return $er->select();}
            ])*/
            ->add('studyLevelNewRegime', ChoiceType::class,
                Array ('choices'=>array(
                    'السلك الاعدادي'=>array(
                        'الأولى إعدادي'=>'الأولى إعدادي',
                        'الثانية إعدادي'=>'الثانية إعدادي',
                        'الثالثة إعدادي'=>'الثالثة إعدادي',
                        'الرابعة إعدادي'=>'الرابعة إعدادي'
                    ),
                    'سلك الجذع المشترك'=>array(
                        'الجذع المشترك العلمي'=>'الجذع مشترك العلمي',
                        'الجذع المشترك آداب وعلوم إنسانية'=>'الجذع المشترك آداب وعلوم إنسانية'
                    ),
                    'سلك الباكالوريا'=>array(
                        'الأولى باكالوريا علوم تجريبية'=>'الأولى باكالوريا علوم تجريبية',
                        'الأولى باكالوريا علوم الحياة والأرض'=>' الأولى باكالوريا علوم الحياة والأرض',
                        'الأولى باكالوريا علوم فزيائية'=>'الأولى باكالوريا علوم فزيائية',
                        'الأولى باكالوريا آداب وعلوم إنسانية'=>'الأولى باكالوريا آداب وعلوم إنسانية',
                        'الثانية باكالوريا علوم تجريبية'=>'الثانية باكالوريا علوم تجريبية',
                        'الثانية باكالوريا الحياة والأرض'=>'الثانية باكالوريا الحياة والأرض',
                        'الثانية باكالوريا علوم فزيائية'=>'الثانية باكالوريا  علوم فزيائية',
                        'الثانية باكالوريا علوم إنسانية'=>'الثانية باكالوريا علوم إنسانية',
                        'الثانية باكالوريا آداب'=>'الثانية باكالوريا آداب',

                    ),
                )))
            ->add('studyLevelOldRegime', ChoiceType::class,
                Array ('choices'=>array(
                    'السلك الاعدادي'=>array(
                        'السادس أساسي'=>'السادس أساسي',
                        'السابعة إعدادي'=>'السابعة إعدادي',
                        'الثامنة إعدادي'=>'الثامنة إعدادي',
                        'التاسعة إعدادي'=>'التاسعة إعدادي'
                    ),
                    'سلك الباكالوريا'=>array(
                        'الأولى ثانوي آداب عصرية'=>'الأولى ثانوي آداب عصرية',
                        'الثانية ثانوي آداب عصرية'=>'الثانية ثانوي آداب عصرية',
                        'الثالثة ثانوي آداب عصرية'=>'الثالثة ثانوي آداب عصرية',
                        'الأولى ثانوي علوم تجريبية'=>'الأولى ثانوي علوم تجريبية',
                        'الثانية ثانوي علوم تجريبية'=>'الثانية ثانوي علوم تجريبية',
                        'الثالية ثانوي علوم تجريبية'=>'الثالية ثانوي علوم تجريبية',

                    ),
                )))

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
