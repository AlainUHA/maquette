<?php

namespace App\Form;

use App\Entity\Bloc;
use App\Entity\Niveau;
use App\Entity\Parcours;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NiveauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('niveau')
            ->add('description')
            /*->add('bloc', EntityType::class, [
                'class' => Bloc::class,
                'choice_label' => 'id',
            ])*/
            ->add('parcours', EntityType::class, [
                'class' => Parcours::class,
                'choice_label' => 'titre',
                'label' => 'Parcours',
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function ($er) use ($options){
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.titre', 'ASC')
                        ->where('p.mention = :mention')
                        ->setParameter('mention', $options['mention']);
                },
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => ['class' => 'btn btn-primary'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Niveau::class,
            'mention' => '',
        ]);
    }
}
