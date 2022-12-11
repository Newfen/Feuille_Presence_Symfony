<?php

namespace App\Controller;

use App\Entity\UserNomine;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StatistiqueController extends AbstractController
{
    #[Route('/statistique', name: 'app_statistique')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(UserNomine::class);

        $user = $this->getUser();

        $statistiques = $repository->findBy(
            ['utilisateur' => $user]
        );

        return $this->render('statistique/index.html.twig', [
            'statistiques' => $statistiques,
        ]);
    }
}
