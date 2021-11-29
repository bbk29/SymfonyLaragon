<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Movie;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ActorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class,['label' => 'Prénom : '])
            ->add('nom', TextType::class,['label' => 'Nom : '])
            //->add('photo', TextType::class,['label' => 'Photo : '])
            ->add('imageFile', VichFileType::class,['required'=>false], ['label' => 'Photo : '])
            ->add('movies', EntityType::class,[
                'mapped' => true,
                'multiple'=>true,
                'class' => Movie::class,
                'choice_label' => 'title',
                'label' => 'Choisir film(s) : ',
                'by_reference' => false,])
            ->add('Enregistrer', SubmitType::class)
            ;
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Actor::class,
        ]);
    }
}
