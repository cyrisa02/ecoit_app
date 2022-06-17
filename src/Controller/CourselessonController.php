<?php

namespace App\Controller;

use App\Entity\Lessons;
use App\Repository\LessonsRepository;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * This controller displays the course for the formation
 */

class CourselessonController extends AbstractController
{
   #[Route('/parcours_leçons', name: 'app_course2', methods: ['GET'])]
    //#[IsGranted('ROLE_USER')]
    public function course(LessonsRepository $lessonsRepository): Response
    {
        return $this->render('pages/lessons/course.html.twig', [
            'lessons' => $lessonsRepository->findAll(),
        ]);
    } 

    #[Route('parcours_leçons/{id}', name: 'app_course2_show', methods: ['GET'])]
    public function show(Lessons $lesson): Response
    {
        return $this->render('pages/lessons/showcourse.html.twig', [
            'lesson' => $lesson,
        ]);
    }
}