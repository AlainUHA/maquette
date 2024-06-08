<?php

namespace App\Controller;

use App\Entity\Mention;
use App\Repository\MentionRepository;
use App\Repository\ParcoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[isGranted('ROLE_USER')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(MentionRepository $mr,ParcoursRepository $pr): Response
    {
        //utilisateur connecté
        $user = $this->getUser();
        //liste des mentions de l'utilisateur
        $mentions = $mr->findByUser($user);
        $parcours = $pr->findByResp($user);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'mentions' => $mentions,
            'parcours' => $parcours
        ]);
    }
}
