<?php

namespace App\Form;

use App\Entity\Ressource;
use App\Entity\UE;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UEType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codeUE', null, [
                'label' => 'Code UE',
            ])
            ->add('libelleUE',  null, [
                'label' => 'Libellé',
            ])
            ->add('ects', null, [
                'label' => 'ECTS',
            ])
            ->add('coeff', null, [
                'label' => 'Coefficient',
            ])
            ->add('m3c', TextareaType::class, [
                'label' => 'M3C',
                'attr' => [
                    "rows" => 5,
                ],
                'help' => 'Détailler le type et le nombre de contrôle. Cf "Aide" pour plus d\'informations',
                'required' => false,

            ])
            ->add('m3cAssiduite', TextareaType::class, [
                'label' => 'M3C pour les étudiants dispensés d\'assiduité',
                'attr' => [
                    "rows" => 5,
                ],
                'required' => false,
            ])
            ->add('m3cSession2', TextareaType::class, [
                'label' => 'M3C Session 2',
                'attr' => [
                    "rows" => 5,
                ],
                'required' => false,
            ])
            ->add('ressources', EntityType::class, [
                'class' => Ressource::class,
                'choice_label' => 'libelle',
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function ($er) use ($options){
                    return $er->createQueryBuilder('r')
                        ->orderBy('r.libelle', 'ASC')
                        ->where('r.mention = :mention')
                        ->setParameter('mention', $options['mention']);
                        }
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UE::class,
            'mention' => '',
            'niveau_id' => '',
        ]);
    }
}
