<?php

namespace App\Form;

use App\Entity\Victime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class VictimeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('description')
            ->add('photo',FileType::class,[
                'label' =>'Choississez une photo',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' =>[
                            'image/jpeg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => 'ceci n\'est pas une image'
                    ])
                ]
            ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Victime::class,
        ]);
    }
}
