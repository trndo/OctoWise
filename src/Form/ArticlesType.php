<?php
/**
 * Created by PhpStorm.
 * User: vel-vet
 * Date: 25.12.18
 * Time: 20:05
 */

namespace App\Form;

use App\Entity\Articles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder,array $options)
    {
        $builder->add('title',TextType::class,[
            'label' => false
        ])
                ->add('description',TextType::class,[
                    'label' => false
                ])
                ->add('img',FileType::class,[
                    'required' => false,
                    'label' => false
                ])
                ->add('text',TextareaType::class,[
                    'required' => false,
                    'label' => 'Текст'
                ])
                ->add('save',SubmitType::class,[
                    'label' => 'Добавить статью'
                ])
                ->getForm();
    }
}