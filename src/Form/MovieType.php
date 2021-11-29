<?php

namespace App\Form;
use App\Entity\Actor;
use App\Entity\Director;
use App\Entity\Genre;
use App\Entity\Movie;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('duration')
            ->add('date', DateType::class, ['years' => range(1900, 2038)] ) //dépasse limitation de form_widget
            ->add('description')
            ->add('cover')
            ->add('Actors', EntityType::class,[
                    'mapped' => true,
                    'multiple'=>true,
                    'class' => Actor::class,
                    'choice_label' => function(Actor $actor) { return $actor->getPrenom().' '.$actor->getNom();},
                    'label' => 'Choisir acteur'
                    ])
            ->add('director', EntityType::class,[
                'mapped' => true,
                'multiple'=>false,
                'class' => Director::class,
                'choice_label' => function(Director $director) { return $director->getPrenom().' '.$director->getNom();},
                'label' => 'Choisir réal.'
                ])
            ->add('genre', EntityType::class,[
                'mapped' => true,
                'multiple'=>false,
                'class' => Genre::class,
                'choice_label' => 'type',
                'label' => 'Choisir genre'
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
