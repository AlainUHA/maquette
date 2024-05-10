<?php

namespace App\Controller;

use App\Entity\ApprentissageCritique;
use App\Entity\Bloc;
use App\Entity\Niveau;
use App\Form\ApprentissageCritiqueType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApprentissageCritiqueController extends AbstractController
{
    #[Route('/niveau/{id}/ac', name: 'ac.creer')]
    public function creerAc(Niveau $niveau, Request $request, EntityManagerInterface $em): Response
    {
        $ac = new ApprentissageCritique();
        $form = $this->createForm(ApprentissageCritiqueType::class, $ac);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $bloc = $niveau->getBloc();
            $ac->setBloc($bloc);
            $ac->setNiveau($niveau);
            $em->persist($ac);
            $em->flush();
            $this->addFlash('success', 'Apprentissage critique créé avec succès');
            return $this->redirectToRoute('blocs.voir', ['id' => $bloc->getMention()->getId()]);
        }
        return $this->render('apprentissage_critique/creer.html.twig', [
            'controller_name' => 'ApprentissageCritiqueController',
            'form' => $form,
        ]);
    }

    #[Route('/ac/{id}/modifier', name: 'ac.modifier')]
    public function modifierAc(ApprentissageCritique $ac, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ApprentissageCritiqueType::class, $ac);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Apprentissage critique modifié avec succès');
            return $this->redirectToRoute('blocs.voir', ['id' => $ac->getBloc()->getMention()->getId()]);
        }
        return $this->render('apprentissage_critique/modifier.html.twig', [
            'controller_name' => 'ApprentissageCritiqueController',
            'form' => $form,
        ]);
    }

    #[Route('/ac/{id}/supprimer', name: 'ac.supprimer')]
    public function supprimerAc(ApprentissageCritique $ac, EntityManagerInterface $em): Response
    {
        $em->remove($ac);
        $em->flush();
        $this->addFlash('success', 'Apprentissage critique supprimé avec succès');
        return $this->redirectToRoute('blocs.voir', ['id' => $ac->getBloc()->getMention()->getId()]);
    }
}
