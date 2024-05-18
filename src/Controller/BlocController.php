<?php

namespace App\Controller;

use App\Entity\ApprentissageCritique;
use App\Entity\Bloc;
use App\Entity\Competence;
use App\Entity\Mention;
use App\Form\BlocType;
use App\Repository\BlocRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[isGranted('ROLE_USER')]
class BlocController extends AbstractController
{
    #[Route('/mention/{id}/blocs', name: 'blocs.voir')]
    public function voirBlocs(BlocRepository $repository,Mention $mention, EntityManagerInterface $em): Response
    {

        $blocs = $repository->findBy(['mention' => $mention]);
        $maxNiveau = 0;
        $ac = [];
        $competences = [];
        foreach ($blocs as $bloc) {
            $competencesDuBloc = $em->getRepository(Competence::class)->findBy(['bloc' => $bloc]);
            $competences[] = $competencesDuBloc;
            foreach ($competencesDuBloc as $competence) {
                //dd($competence);
                    $niveaux = $competence->getNiveaux();
                    foreach ($niveaux as $niveau) {
                        if ($niveau->getNiveau() > $maxNiveau) {
                            $maxNiveau = $niveau->getNiveau();
                        }
                        $ac[] = $em->getRepository(ApprentissageCritique::class)->findBy(['niveau' => $niveau]);
                    }
            }

        }
        //dd($competences);
        return $this->render('bloc/index.html.twig', [
            'controller_name' => 'BlocController',
            'blocs' => $blocs,
            'competences' => $competences,
            'mention' => $mention,
            'maxNiveau' => $maxNiveau,
            'ac' => $ac,
        ]);
    }

    #[Route('/mention/bloc/{id}', name: 'bloc.voir', requirements: ['id' => '\d+'])]
    public function voirBloc(int $id, BlocRepository $repository): Response
    {
        $bloc = $repository->find($id);
        return $this->render('bloc/voir.html.twig', [
            'controller_name' => 'BlocController',
            'id' => $id,
            'bloc' => $bloc,
        ]);
    }

    #[Route('/mention/bloc/{id}/modifier', name: 'bloc.modifier', requirements: ['id' => '\d+'])]
    public function modifierBloc(Bloc $bloc, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(BlocType::class, $bloc);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Bloc modifié avec succès');
            return $this->redirectToRoute('blocs.voir', ['id' => $bloc->getMention()->getId()]);
        }
        return $this->render('bloc/modifier.html.twig', [
            'bloc' => $bloc,
            'form' => $form,
        ]);
    }

    #[Route('/mention/{id}/bloc/creer', name: 'bloc.creer')]
    public function creerBloc(Mention $mention, Request $request, EntityManagerInterface $em): Response
    {
        $bloc = new Bloc();
        $options = [];
        $options['mention'] = $mention->getId();
        $form = $this->createForm(BlocType::class, $bloc,$options);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $bloc->setMention($mention);
            $em->persist($bloc);
            $em->flush();
            $this->addFlash('success', 'Bloc créé avec succès');
            return $this->redirectToRoute('bloc.voir', ['id' => $bloc->getId()]);
        }
        return $this->render('bloc/creer.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/mention/bloc/{id}/supprimer', name: 'bloc.supprimer', requirements: ['id' => '\d+'])]
    public function supprimerBloc(Bloc $bloc, EntityManagerInterface $em): Response
    {
        $em->remove($bloc);
        $em->flush();
        $this->addFlash('success', 'Bloc supprimé avec succès');
        return $this->redirectToRoute('blocs.voir');
    }
}
