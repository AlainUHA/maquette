<?php

namespace App\Controller;

use App\Entity\Mention;
use App\Entity\Parcours;
use App\Form\ParcoursType;
use App\Repository\ParcoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[isGranted('ROLE_USER')]
class ParcoursController extends AbstractController
{
    #[Route('/parcours', name: 'parcours.voir')]
    public function index(): Response
    {
        return $this->render('parcours/index.html.twig', [
            'controller_name' => 'ParcoursController',
        ]);
    }

    #[Route('/parcours/{id}', name: 'p.voir', requirements: ['id' => '\d+'])]
    public function voirParcours(int $id, ParcoursRepository $repository): Response
    {
        $parcours = $repository->find($id);
        return $this->render('parcours/voir.html.twig', [
            'controller_name' => 'ParcoursController',
            'id' => $id,
            'parcours' => $parcours,
        ]);
    }

    #[Route('/parcours/{id}/modifier', name: 'parcours.modifier', requirements: ['id' => '\d+'])]
    public function modifierParcours(Parcours $parcours, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ParcoursType::class, $parcours);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $parcours->setModifiedAt(new \DateTimeImmutable());
            $em->flush();
            $this->addFlash('success', 'Parcours modifié avec succès');
            return $this->redirectToRoute('mention.voir', ['id' => $parcours->getMention()->getId()]);
        }
        return $this->render('parcours/modifier.html.twig', [
            'parcours' => $parcours,
            'form' => $form,
        ]);
    }

    #[Route('mention/{id}/parcours/creer', name: 'parcours.creer')]
    public function creerParcours(Mention $mention, Request $request, EntityManagerInterface $em): Response
    {
        $parcours = new Parcours();
        $form = $this->createForm(ParcoursType::class, $parcours);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $parcours->setCreatedAt(new \DateTimeImmutable());
            $parcours->setModifiedAt(new \DateTimeImmutable());
            $parcours->setMention($mention);
            $em->persist($parcours);
            $em->flush();
            $this->addFlash('success', 'Parcours créé avec succès');
            return $this->redirectToRoute('mention.voir', ['id' => $parcours->getMention()->getId()]);
        }
        return $this->render('parcours/creer.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/parcours/{id}/supprimer', name: 'parcours.supprimer', requirements: ['id' => '\d+'])]
    public function supprimerParcours(Parcours $parcours, EntityManagerInterface $em): Response
    {
        $em->remove($parcours);
        $em->flush();
        $this->addFlash('success', 'Parcours supprimé avec succès');
        return $this->redirectToRoute('mention.voir',['id' => $parcours->getMention()->getId()]);
    }

    #[Route('/parcours/{id}/referentiel', name: 'parcours.voirReferentiel', requirements: ['id' => '\d+'])]
    public function voirReferentielParcours(Parcours $parcours): Response
    {
        $niveaux = $parcours->getNiveaux();
        $blocs = [];
        $competences = [];
        foreach ($niveaux as $niveau) {
            if (!in_array($niveau->getCompetence()->getBloc(), $blocs))
                $blocs[] = $niveau->getCompetence()->getBloc();
            if (!in_array($niveau->getCompetence(), $competences))
                {
                    $competences[] = $niveau->getCompetence();
                }
        }
        return $this->render('parcours/referentiel.html.twig', [
            'controller_name' => 'ParcoursController',
            'parcours' => $parcours,
            'blocs' => $blocs,
            'niveaux' => $niveaux,
            'competences' => $competences,
        ]);
    }
}
