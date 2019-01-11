<?php

namespace App\Form;

use App\Entity\Contacts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'label' => false
            ])
            ->add('email',EmailType::class,[
                'label' => false
                ])
            ->add('telNumber',TelType::class,[
                'label' => false
            ])
            ->add('information',TextType::class,[
                'label' => false
            ])
            ->add('save',SubmitType::class,[
                'label' => 'Отправить',
                ])
            ->getForm();
        ;
    }

    public function configureOptions(OptionsResolver $resolver)

    {
        $resolver->setDefaults([
            'data_class' => Contacts::class
        ]);
    }
}
