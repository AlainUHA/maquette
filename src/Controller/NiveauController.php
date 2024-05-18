<?php

namespace App\Controller;

use App\Entity\Bloc;
use App\Entity\Competence;
use App\Entity\Niveau;
use App\Form\NiveauType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NiveauController extends AbstractController
{
    #[Route('competence/{id}/niveau/creer', name: 'niveau.creer')]
    public function creerNiveau(Competence $competence, Request $request, EntityManagerInterface $em): Response
    {
        $niveau = new Niveau();
        $options = ['mention' => $competence->getBloc()->getMention()];
        $form = $this->createForm(NiveauType::class, $niveau,$options);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $niveau->setCompetence($competence);
            $em->persist($niveau);
            $em->flush();
            $this->addFlash('success', 'Niveau créé avec succès');
            return $this->redirectToRoute('blocs.voir', ['id' => $competence->getBloc()->getMention()->getId()]);
        }

        return $this->render('niveau/creer.html.twig', [
            'competence' => $competence,
            'form' => $form,
        ]);
    }

    #[Route('niveau/{id}/modifier', name: 'niveau.modifier')]
    public function modifierNiveau(Niveau $niveau, Request $request, EntityManagerInterface $em): Response
    {
        $options = ['mention' => $niveau->getCompetence()->getBloc()->getMention()];
        $form = $this->createForm(NiveauType::class, $niveau,$options);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Niveau modifié avec succès');
            return $this->redirectToRoute('blocs.voir', ['id' => $niveau->getCompetence()->getBloc()->getMention()->getId()]);
        }

        return $this->render('niveau/modifier.html.twig', [
            'niveau' => $niveau,
            'form' => $form,
        ]);
    }

    #[Route('niveau/{id}/supprimer', name: 'niveau.supprimer')]
    public function supprimerNiveau(Niveau $niveau, EntityManagerInterface $em): Response
    {
        $ac=$niveau->getApprentissagesCritiques();
        foreach ($ac as $a){
            $em->remove($a);
        }
        $em->remove($niveau);
        $em->flush();
        $this->addFlash('success', 'Niveau supprimé avec succès');
        return $this->redirectToRoute('blocs.voir', ['id' => $niveau->getCompetence()->getBloc()->getMention()->getId()]);
    }

}
