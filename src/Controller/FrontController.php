<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Victime;
use App\Repository\VictimeRepository;

class FrontController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(VictimeRepository $victimeRepository )
    {
        return $this->render('front/index.html.twig', [
            'victimes' => $victimeRepository->findAll(),
        ]);
    }
}
