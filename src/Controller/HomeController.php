<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;
use App\Repository\UsersRepository;
use App\Entity\Formations;
use App\Repository\FormationsRepository;

/**
 * This controller displays the homepage
 */

class HomeController extends AbstractController
{
    #[Route('/', name: 'home.index', methods: ['GET'])]
    public function index(FormationsRepository $formationsRepository, UsersRepository $usersRepository): Response
    {
        return $this->render('pages/home.html.twig', [
            'formations' => $formationsRepository->findAll(),
            'users' =>
            $usersRepository->findAll(),
        ]);
    }
}