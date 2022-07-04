<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Formations;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\UsersRepository;
use App\Repository\LessonsRepository;
use App\Repository\FormationsRepository;
use App\Repository\EndedLessonsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * This controller displays the homepage
 */

class HomeController extends AbstractController
{
    #[Route('/', name: 'home.index', methods: ['GET'])]
    public function index(FormationsRepository $formationsRepository, UsersRepository $usersRepository, LessonsRepository $lessonsRepository,EndedLessonsRepository $endedLessonsRepository, Request $request): Response
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        return $this->render('pages/home.html.twig', [
            'formations' => $formationsRepository->findAll(),
            'users' =>
            $usersRepository->findAll(),
            'lessons' => $lessonsRepository->findAll(),
            'ended_lessons' => $endedLessonsRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }
}