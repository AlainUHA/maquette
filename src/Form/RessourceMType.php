<?php

namespace App\Form;

use App\Entity\Mention;
use App\Entity\Parcours;
use App\Entity\Ressource;
use App\Entity\Typologie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RessourceMType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', null, [
                'label' => 'Libellé',
            ])
            ->add('commun', null, [
                'label' => 'Commun Mention',
                'help' => 'Cette ressource est commune à TOUS les parcours de la mention'
            ])
            ->add('typologie', EntityType::class, [
                'class' => Typologie::class,
                'choice_label' => 'libelle',
                'placeholder' => 'Choisir une typologie',
                'label' => 'Typologie',
            ])
            ->add('ci', null, [
                'label' => 'Heures CI',
                'attr' => ['class' => 'w200'],
            ])
            ->add('cm', null, [
                'label' => 'Heures CM',
                'attr' => ['class' => 'w200'],
            ])
            ->add('td', null, [
                'label' => 'Heures TD',
                'attr' => ['class' => 'w200'],
            ])
            ->add('tp', null, [
                'label' => 'Heures TP',
                'attr' => ['class' => 'w200'],
            ])
            ->add('hybride', null, [
                'label' => 'Hybride',
                'help' => 'Cette ressource est hybride, c\'est-à-dire qu\'elle est à la fois en présentiel et en distanciel'
            ])
            ->add('projetAutonomie', null, [
                'label' => 'Heures Projet en autonomie',
                'attr' => ['class' => 'w200'],
            ])
            ->add('ctInternationale', null, [
                'label' => 'Internationale',
                'help' => 'Cette ressource permet de travailler la dimension internationale, par exemple avec un cours en anglais'
            ])
            ->add('ctProfessionnelle', null, [
                'label' => 'Professionnelle',
                'help' => 'Cette ressource permet de travailler l\'insertion professionnelle, par exemple avec un cours sur le CV et la lettre de motivation'
            ])
            ->add('ctNumerique', null, [
                'label' => 'Numérique',
                'help' => 'Cette ressource permet de travailler les compétences numériques métiers'
            ])
            ->add('ctRecherche', null, [
                'label' => 'Recherche',
                'help' => 'Cette ressource permet de s\'initier à la recherche'
            ])
            ->add('ctCollaboratif', null, [
                'label' => 'Collaboratif',
                'help' => 'Cette ressource permet de travailler les compétences collaboratives'
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
            'data_class' => Ressource::class,
        ]);
    }
}
