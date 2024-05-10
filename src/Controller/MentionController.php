<?php

namespace App\Controller;

use App\Entity\Mention;
use App\Form\MentionType;
use App\Repository\MentionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[isGranted('ROLE_USER')]
class MentionController extends AbstractController
{
    #[Route('/mentions', name: 'mentions.voir', requirements: ['id' => '\d+'])]
    public function VoirMentions(Request $request,MentionRepository $repository, EntityManagerInterface $em): Response
    {
        $mentions = $em->getRepository(Mention::class)->findAll();
        return $this->render('mention/index.html.twig', [
            'controller_name' => 'MentionController',
            'mentions' => $mentions,
        ]);
    }

    #[Route('/mention/{id}', name: 'mention.voir', requirements: ['id' => '\d+'])]
    public function VoirMention(int $id, MentionRepository $repository): Response
    {
        $mention = $repository->find($id);
        $parcours = $mention->getParcours();
        return $this->render('mention/mention.html.twig', [
            'controller_name' => 'MentionController',
            'id' => $id,
            'mention' => $mention,
            'parcours' => $parcours,
        ]);
    }

    #[Route('/mention/{id}/modifier', name: 'mention.modifier', requirements: ['id' => '\d+'])]
    public function ModifierMention(Mention $mention, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(MentionType::class, $mention);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $mention->setModifiedAt(new \DateTimeImmutable());
            $em->flush();
            $this->addFlash('success', 'Mention modifiée avec succès');
            return $this->redirectToRoute('mention.voir', ['id' => $mention->getId()]);
        }
        return $this->render('mention/modifier.html.twig', [
            'mention' => $mention,
            'form' => $form,
        ]);
    }
    #[Route('/mention/creer', name: 'mention.creer')]
    public function CreerMention(Request $request, EntityManagerInterface $em): Response
    {
        $mention = new Mention();
        $form = $this->createForm(MentionType::class, $mention);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $mention->setCreatedAt(new \DateTimeImmutable());
            $mention->setModifiedAt(new \DateTimeImmutable());
            $em->persist($mention);
            $em->flush();
            $this->addFlash('success', 'Mention créée avec succès');
            return $this->redirectToRoute('mention.voir', ['id' => $mention->getId()]);
        }
        return $this->render('mention/creer.html.twig', [
            'mention' => $mention,
            'form' => $form,
        ]);
    }

    #[Route('/mention/{id}/supprimer', name: 'mention.supprimer', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    public function SupprimerMention(Mention $mention, EntityManagerInterface $em): Response
    {
        $em->remove($mention);
        $em->flush();
        $this->addFlash('success', 'Mention supprimée avec succès');
        return $this->redirectToRoute('mentions.voir');
    }
}
