<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Cover;
use App\Entity\Fan;
use App\Entity\Style;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlbumFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('style' , EntityType::class, [
                'class' => Style::class,
                'choice_label' => 'name',
            ])
            ->add('fans' , EntityType::class, [
                'class' =>  Fan::class,
                'choice_label' => 'username ',
                'multiple' => true,
            ])
            ->add('artist' , EntityType::class, [
                'class' => Artist::class,
                'choice_label' => 'name',
            ])
            ->add('cover' , EntityType::class, [
                'class' => Cover::class,
                'choice_label' => 'albumName',
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}
