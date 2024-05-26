<?php

namespace App\Controller;

use App\Entity\Mention;
use App\Entity\Ressource;
use App\Form\RessourceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RessourceController extends AbstractController
{
    #[Route('mention/{id}/ressources', name: 'ressources.voir')]
    public function index(Mention $mention): Response
    {
        $ressources = $mention->getRessources();
        return $this->render('ressource/index.html.twig', [
            'controller_name' => 'RessourceController',
            'ressources' => $ressources,
            'mention' => $mention,
        ]);
    }

    #[Route('mention/{id}/ressource/creer', name: 'ressource.creer')]
    public function creer(Mention $mention, Request $request, EntityManagerInterface $em): Response
    {
        $ressource = new Ressource();
        $form = $this->createForm(RessourceType::class, $ressource);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ressource->setMention($mention);
            $em->persist($ressource);
            $em->flush();
            $this->addFlash('success', 'Ressource créée avec succès');
            return $this->redirectToRoute('ressources.voir', ['id' => $mention->getId()]);
        }
        return $this->render('ressource/creer.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
