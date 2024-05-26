<?php

namespace App\Form;

use App\Entity\Mention;
use App\Entity\Ressource;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RessourceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', null, [
                'label' => 'Libellé',
            ])
            ->add('typologie', null, [
                'label' => 'Typologie',
            ])
            ->add('ci', null, [
                'label' => 'Heures CI',
            ])
            ->add('cm', null, [
                'label' => 'Heures CM',
            ])
            ->add('td', null, [
                'label' => 'Heures TD',
            ])
            ->add('tp', null, [
                'label' => 'Heures TP',
            ])
            ->add('projetAutonomie', null, [
                'label' => 'Heures Projet en autonomie',
                'help' => 'Heures de travail personnel de l\'étudiant sur le projet'
            ])
            ->add('ctExpression', null, [
                'label' => 'Expression',
                'help' => 'Cette ressource permet de travailler l\'expression écrite et orale, par exemple avec Ecri+'
            ])
            ->add('ctInternationale', null, [
                'label' => 'Internationale',
                'help' => 'Cette ressource permet de travailler la dimension internationale, par exemple avec un cours en anglais'
            ])
            ->add('ctNumeriquePix', null, [
                'label' => 'Numérique (PIX)',
                'help' => 'Cette ressource permet de travailler la compétence numérique, par exemple avec Pix'
            ])
            ->add('ctTeds', null, [
                'label' => 'TEDS',
                'help' => 'Cette ressource permet de travailler la TEDS (Transition écologique et développement soutenable)'
            ])
            ->add('ctMtu', null, [
                'label' => 'MTU',
                'help' => 'Cette ressource permet de travailler la MTU (Méthodologie du travail universitaire)'
            ])
            ->add('ctProfessionnelle', null, [
                'label' => 'Professionnelle',
                'help' => 'Cette ressource permet de travailler l\'insertion professionnelle, par exemple avec un cours sur le CV et la lettre de motivation'
            ])
            ->add('ctInformationnelle', null, [
                'label' => 'Informationnelle',
                'help' => 'Cette ressource permet de travailler les compétences informationnelles, par exemple les modules du Learning Center'
            ])
            ->add('vssh', null, [
                'label' => 'VSSH',
                'help' => 'Cette ressource traite des VSSH (Violence Sexiste et Sexuelle et Harcèlement)'
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
