<?php

namespace App\Form;

use App\Entity\Bloc;
use App\Entity\mention;
use App\Entity\Parcours;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParcoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', null, [
                'label' => 'Intitulé',
            ])
            ->add('resp', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => function (Utilisateur $utilisateur) {
                    return $utilisateur->getNomComplet();
                },
                'label' => 'Responsable du parcours',
            ])
            ->add('referent', null, [
                'label' => 'Référent du parcours étudiant',
            ])
            ->add('min_stage', null, [
                'label' => 'Durée minimale du stages',
            ])
            ->add('max_stage', null, [
                'label' => 'Durée maximale du stages',
            ])
            /*->add('mention', EntityType::class, [
                'class' => mention::class,
                'choice_label' => 'titre',
                'label' => 'Mention',
            ])*/
            /*->add('blocs', EntityType::class, [
                'class' => Bloc::class,
                'choice_label' => 'id',
                'multiple' => true,
                'label' => 'Blocs de compétences',
            ])*/
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
            ])
            ->add('createdAt', null, [
                'widget' => 'single_text',
                'label' => 'Créée le',
                'disabled' => true,
            ])
            ->add('modifiedAt', null, [
                'widget' => 'single_text',
                'label' => 'Modifiée le',
                'disabled' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Parcours::class,
        ]);
    }
}
