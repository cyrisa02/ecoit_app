<?php

namespace App\Controller;

use App\Entity\EndedLessons;
use App\Form\EndedLessonsType;
use App\Repository\EndedLessonsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/progression')]
class EndedLessonsController extends AbstractController
{
    #[Route('/', name: 'app_ended_lessons_index', methods: ['GET'])]
    public function index(EndedLessonsRepository $endedLessonsRepository): Response
    {
        return $this->render('pages/ended_lessons/index.html.twig', [
            'ended_lessons' => $endedLessonsRepository->findAll(),
        ]);
    }

    #[Route('/creation', name: 'app_ended_lessons_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EndedLessonsRepository $endedLessonsRepository): Response
    {
        $endedLesson = new EndedLessons();
        $form = $this->createForm(EndedLessonsType::class, $endedLesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $endedLessonsRepository->add($endedLesson, true);

            return $this->redirectToRoute('app_ended_lessons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/ended_lessons/new.html.twig', [
            'ended_lesson' => $endedLesson,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ended_lessons_show', methods: ['GET'])]
    public function show(EndedLessons $endedLesson): Response
    {
        return $this->render('pages/ended_lessons/show.html.twig', [
            'ended_lesson' => $endedLesson,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_ended_lessons_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EndedLessons $endedLesson, EndedLessonsRepository $endedLessonsRepository): Response
    {
        $form = $this->createForm(EndedLessonsType::class, $endedLesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $endedLessonsRepository->add($endedLesson, true);

            return $this->redirectToRoute('app_ended_lessons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/ended_lessons/edit.html.twig', [
            'ended_lesson' => $endedLesson,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ended_lessons_delete', methods: ['POST'])]
    public function delete(Request $request, EndedLessons $endedLesson, EndedLessonsRepository $endedLessonsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$endedLesson->getId(), $request->request->get('_token'))) {
            $endedLessonsRepository->remove($endedLesson, true);
        }

        return $this->redirectToRoute('app_ended_lessons_index', [], Response::HTTP_SEE_OTHER);
    }
}