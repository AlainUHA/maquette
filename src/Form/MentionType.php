<?php

namespace App\Form;

use App\Entity\Composante;
use App\Entity\grade;
use App\Entity\Mention;
use App\Entity\utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MentionType extends AbstractType
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
                'label' => 'Responsable de la mention',
                'placeholder' => 'Choisir un responsable',
            ])
            ->add('grade', EntityType::class, [
                'class' => grade::class,
                'choice_label' => 'grade',
                'label' => 'Grade de la mention',
                'placeholder' => 'Choisir un grade',
            ])
            ->add('rncp', null, [
                'label' => 'Code RNCP',
                'help' => 'Saisir uniquement les chiffres',
            ])
            ->add('composante', EntityType::class, [
                'class' => Composante::class,
                'choice_label' => 'libelle',
                'label' => 'Composante',
                'placeholder' => 'Choisir une composante',
            ])
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
            'data_class' => Mention::class,
        ]);
    }
}
