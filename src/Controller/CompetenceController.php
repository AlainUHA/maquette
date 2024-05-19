<?php

namespace App\Controller;

use App\Entity\Bloc;
use App\Entity\Competence;
use App\Form\CompetenceType;
use App\Repository\CompetenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CompetenceController extends AbstractController
{
    #[Route('/competences', name: 'competences.voir')]
    public function index(): Response
    {
        return $this->render('competence/index.html.twig', [
            'controller_name' => 'CompetenceController',
        ]);
    }

    #[Route('/competence/{id}', name: 'competence.voir', requirements: ['id' => '\d+'])]
    public function voirCompetence(Competence $competence, CompetenceRepository $repository): Response
    {
        return $this->render('competence/voir.html.twig', [
            'controller_name' => 'CompetenceController',
            'competence' => $competence,
        ]);
    }

    #[Route('/competence/{id}/modifier', name: 'competence.modifier', requirements: ['id' => '\d+'])]
    public function modifierCompetence(Competence $competence,Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Compétence modifiée avec succès');
            return $this->redirectToRoute('blocs.voir', ['id' => $competence->getBloc()->getMention()->getId()]);
        }
        return $this->render('competence/modifier.html.twig', [
            'controller_name' => 'CompetenceController',
            'competence' => $competence,
        ]);
    }

    #[Route('/competence/{id}/supprimer', name: 'competence.supprimer', requirements: ['id' => '\d+'])]
    public function supprimerCompetence(Competence $competence, EntityManagerInterface $em): Response
    {
        $em->remove($competence);
        $em->flush();
        $this->addFlash('success', 'Compétence supprimée avec succès');
        return $this->redirectToRoute('blocs.voir', ['id' => $competence->getBloc()->getMention()->getId()]);
    }

    #[Route('/bloc/{id}/competence/creer', name: 'competence.creer')]
    public function creerCompetence(Bloc $bloc,Request $request, EntityManagerInterface $em): Response
    {
        $competence = new Competence();
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $competence->setBloc($bloc);
            $em->persist($competence);
            $em->flush();
            $this->addFlash('success', 'Compétence créée avec succès');
            return $this->redirectToRoute('blocs.voir', ['id' => $competence->getBloc()->getMention()->getId()]);
        }
        return $this->render('competence/creer.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/bloc/{id}/competence/creervide', name: 'competence.creervide')]
    public function creerCompetenceVide(Bloc $bloc,Request $request, EntityManagerInterface $em): Response
    {
        $competence = new Competence();
        $competence->setBloc($bloc);
        $em->persist($competence);
        $em->flush();
        return $this->redirectToRoute('blocs.voir', ['id' => $competence->getBloc()->getMention()->getId()]);
    }
}
