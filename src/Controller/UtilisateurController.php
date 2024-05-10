<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[isGranted('ROLE_ADMIN')]
class UtilisateurController extends AbstractController
{
    #[Route('/utilisateurs', name: 'utilisateurs.voir')]
    public function VoirUtilisateurs(UtilisateurRepository $repository): Response
    {
        $utilisateurs = $repository->findAll();
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
            'utilisateurs' => $utilisateurs,
        ]);
    }
    #[Route('/utilisateur/{id}', name: 'utilisateur.voir', requirements: ['id' => '\d+'])]
    public function VoirUtilisateur(int $id, UtilisateurRepository $repository): Response
    {
        $utilisateur = $repository->find($id);
        return $this->render('utilisateur/voir.html.twig', [
            'controller_name' => 'UtilisateurController',
            'id' => $id,
            'utilisateur' => $utilisateur,
        ]);
    }

    #[Route('/utilisateur/{id}/modifier', name: 'utilisateur.modifier', requirements: ['id' => '\d+'])]
    public function ModifierUtilisateur(Utilisateur $utilisateur, UserPasswordHasherInterface $userPasswordHasher, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateur->setPassword(
                $userPasswordHasher->hashPassword(
                    $utilisateur,
                    $form->get('plainPassword')->getData()
                ));
            $em->flush();
            $this->addFlash('success', 'Utilisateur modifié avec succès');
            return $this->redirectToRoute('utilisateur.voir', ['id' => $utilisateur->getId()]);
        }
        return $this->render('utilisateur/modifier.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/utilisateur/creer', name: 'utilisateur.creer')]
    public function CreerUtilisateur(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $em): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateur->setPassword(
                $userPasswordHasher->hashPassword(
                    $utilisateur,
                    $form->get('plainPassword')->getData()
                ));
            $em->persist($utilisateur);
            $em->flush();
            $this->addFlash('success', 'Utilisateur créé avec succès');
            return $this->redirectToRoute('utilisateur.voir', ['id' => $utilisateur->getId()]);
        }
        return $this->render('utilisateur/creer.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/utilisateur/{id}/supprimer', name: 'utilisateur.supprimer', requirements: ['id' => '\d+'],methods: ['DELETE'])]
    public function SupprimerUtilisateur(Utilisateur $utilisateur, EntityManagerInterface $em): Response
    {
        $em->remove($utilisateur);
        $em->flush();
        $this->addFlash('success', 'Utilisateur supprimé avec succès');
        return $this->redirectToRoute('utilisateurs.voir');
    }
}
