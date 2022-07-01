<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;
use App\Repository\UsersRepository;
use App\Entity\Formations;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\FormationsRepository;
use App\Repository\LessonsRepository;
use Symfony\Component\HttpFoundation\Request;

/**
 * This controller displays the homepage
 */

class HomeController extends AbstractController
{
    #[Route('/', name: 'home.index', methods: ['GET'])]
    public function index(FormationsRepository $formationsRepository, UsersRepository $usersRepository, LessonsRepository $lessonsRepository, Request $request): Response
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        return $this->render('pages/home.html.twig', [
            'formations' => $formationsRepository->findAll(),
            'users' =>
            $usersRepository->findAll(),
            'lessons' => $lessonsRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }
}