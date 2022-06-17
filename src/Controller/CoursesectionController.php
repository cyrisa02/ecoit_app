<?php

namespace App\Controller;

use App\Entity\Sections;
use App\Form\SectionsType;

use App\Repository\SectionsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * This controller displays the course for the formation
 */

class CoursesectionController extends AbstractController
{
   #[Route('/parcours_sections', name: 'app_course1', methods: ['GET'])]
    //#[IsGranted('ROLE_USER')]
    public function course(SectionsRepository $sectionsRepository): Response
    {
        return $this->render('pages/sections/course.html.twig', [
            'sections' => $sectionsRepository->findAll(),
        ]);
    } 

// #[Route('/creation', name: 'app_course1_new', methods: ['GET', 'POST'])]
//     //#[IsGranted('ROLE_USER')]
//     public function new(Request $request, SectionsRepository $sectionsRepository): Response
//     {
//         $section = new Sections();
//         $form = $this->createForm(SectionsType::class, $section);
//         $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) {
//             $sectionsRepository->add($section, true);

//             return $this->redirectToRoute('app_course1', [], Response::HTTP_SEE_OTHER);
//         }

//         return $this->renderForm('pages/sections/course.html.twig', [
//             'section' => $section,
//             'form' => $form,
//         ]);
//     }

    #[Route('parcours_sections/{id}', name: 'app_course1_show', methods: ['GET'])]
    public function show(Sections $section): Response
    {
        return $this->render('pages/sections/showcourse.html.twig', [
            'section' => $section,
        ]);
    }
}