<?php

namespace App\Controller;

use App\Entity\Mention;
use App\Entity\Ressource;
use App\Entity\Typologie;
use App\Form\RessourceLType;
use App\Form\RessourceMType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

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
        if ($mention->getGrade()->getId() == 1 || $mention->getGrade()->getId() == 2)
        {
            $form = $this->createForm(RessourceLType::class, $ressource);
        }
        else {
            $form = $this->createForm(RessourceMType::class, $ressource);
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ressource->setMention($mention);
            $em->persist($ressource);
            $em->flush();
            $this->addFlash('success', 'Ressource créée avec succès');
            return $this->redirectToRoute('ressources.voir', ['id' => $mention->getId()]);
        }
        if ($mention->getGrade()->getId() == 1 || $mention->getGrade()->getId() == 2)
        {
            return $this->render('ressource/creerL.html.twig', [
                'form' => $form->createView(),
                'mention' => $mention,
            ]);
        }
        else {
            return $this->render('ressource/creerM.html.twig', [
                'form' => $form->createView(),
                'mention' => $mention,
            ]);
        }
    }

    #[Route('ressource/{id}/modifier', name: 'ressource.modifier')]
    public function modifier(Ressource $ressource, Request $request, EntityManagerInterface $em): Response
    {
        $mention = $ressource->getMention();
        if ($mention->getGrade()->getId() == 1 || $mention->getGrade()->getId() == 2)
        {
            $form = $this->createForm(RessourceLType::class, $ressource);
        }
        else {
            $form = $this->createForm(RessourceMType::class, $ressource);
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Ressource modifiée avec succès');
            return $this->redirectToRoute('ressources.voir', ['id' => $ressource->getMention()->getId()]);
        }
        if ($mention->getGrade()->getId() == 1 || $mention->getGrade()->getId() == 2)
        {
            return $this->render('ressource/modifierL.html.twig', [
                'form' => $form->createView(),
                'mention' => $mention,
            ]);
        }
        else {
            return $this->render('ressource/modifierM.html.twig', [
                'form' => $form->createView(),
                'mention' => $mention,
            ]);
        }
    }
    #[isGranted('ROLE_ADMIN')]
    #[Route('mention/{id}/ressources/importer', name: 'ressources.importer')]
    public function importerRessources(Mention $mention, EntityManagerInterface $em): Response
    {
        //$file = $request->files->get('fichier');
        $fichier = fopen('ressources.csv', 'r');
        $typologie = $em->getRepository(Typologie::class)->findOneBy(['libelle' => 'Socle']);
        while ($ligne = fgetcsv($fichier, 0, ';')) {
            $ressource = new Ressource();
            $ressource->setMention($mention);
            $ressource->setLibelle($ligne[0]);
            $ressource->setTypologie($typologie);
            $em->persist($ressource);
            $em->flush();
        }

        $this->addFlash('success', 'Ressources importées avec succès');
        return $this->redirectToRoute('ressources.voir', ['id' => $mention->getId()]);
    }

}
