<?php

namespace App\Controller;

use App\Entity\Mention;
use App\Entity\Niveau;
use App\Entity\UE;
use App\Form\UEType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UEController extends AbstractController
{
    #[Route('mention/{id}/ues', name: 'ues.voir')]
    public function voirUEs(Mention $mention): Response
    {
        $blocs = $mention->getBlocs();
        return $this->render('ue/index.html.twig', [
            'controller_name' => 'UEController',
            'mention' => $mention,
            'blocs' => $blocs,
        ]);
    }

    #[Route('mention/{id}/niveau/{id_niveau}/ue/creer', name: 'ue.creer')]
    public function creerUE(Mention $mention, int $id_niveau, Request $request, EntityManagerInterface $em): Response
    {
        $ue = new UE();
        $niveau = $em->getRepository(Niveau::class)->find($id_niveau);
        $options = [
            'mention' => $mention,
            'niveau' => $niveau->getNiveau(),
        ];


        $form = $this->createForm(UeType::class, $ue,$options);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $parcours=$niveau->getParcours();
            foreach ($parcours as $p){
                $ue->addParcour($p);
            }
            $ue->setNiveau($niveau);
            $ue->setMention($mention);
            $em->persist($ue);
            $em->flush();
            return $this->redirectToRoute('ues.voir', ['id' => $mention->getId()]);
        }
        return $this->render('ue/creer.html.twig', [
            'controller_name' => 'UEController',
            'form' => $form->createView(),
            'mention' => $mention,
        ]);
    }

    #[Route('ue/{id}/modifier', name: 'ue.modifier')]
    public function modifierUE(UE $ue, Request $request, EntityManagerInterface $em): Response
    {
        $mention = $ue->getMention();
        $niveau = $ue->getNiveau();
        $options = [
            'mention' => $mention,
            'niveau' => $niveau->getNiveau(),
        ];
        $form = $this->createForm(UeType::class, $ue,$options);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('ues.voir', ['id' => $ue->getMention()->getId()]);
        }
        return $this->render('ue/modifier.html.twig', [
            'controller_name' => 'UEController',
            'form' => $form->createView(),
            'mention' => $ue->getMention(),
        ]);
    }
}
