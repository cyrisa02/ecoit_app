<?php

namespace App\Controller;


use App\Entity\Users;
use App\Repository\UsersRepository;
use App\Entity\Formations;

use App\Repository\FormationsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * This controller displays the course for the formation
 */

class CourseController extends AbstractController
{
    

    #[Route('/parcours', name: 'app_course', methods: ['GET'])]
    // // #[IsGranted('ROLE_USER')]
    public function course(FormationsRepository $formationsRepository, UsersRepository $usersRepository, ): Response 
    {
        return $this->render('pages/formations/course.html.twig', [
            'formations' => $formationsRepository->findAll(),
            'users' =>
            $usersRepository->findAll(),
            
        ]);
     }


     // #[Security("is_granted('ROLE_USER') and user === formation.getUsers()")]
    #[Route('parcours/{id}', name: 'app_course_show', methods: ['GET'])]
    public function show(Formations $formation): Response
    {
        return $this->render('pages/formations/showcourse.html.twig', [
            'formation' => $formation,
        ]);
    }


    
}