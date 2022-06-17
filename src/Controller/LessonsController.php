<?php

namespace App\Controller;

use App\Entity\Lessons;
use App\Form\LessonsType;
use App\Repository\LessonsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



#[Route('/leçons')]
class LessonsController extends AbstractController
{
    #[Route('/', name: 'app_lessons_index', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(LessonsRepository $lessonsRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $lessons = $lessonsRepository->findAll();

        $lessons =$paginator->paginate(
            $lessons,
            
            $request->query->getInt('page', 1),
            1
        );


        return $this->render('pages/lessons/index.html.twig', [
            'lessons' => $lessons,
        ]);
    }

    #[Route('/creation', name: 'app_lessons_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, LessonsRepository $lessonsRepository): Response
    {
        $lesson = new Lessons();
        $form = $this->createForm(LessonsType::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lessonsRepository->add($lesson, true);

            return $this->redirectToRoute('app_lessons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/lessons/new.html.twig', [
            'lesson' => $lesson,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lessons_show', methods: ['GET'])]
    public function show(Lessons $lesson): Response
    {
        return $this->render('pages/lessons/show.html.twig', [
            'lesson' => $lesson,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_lessons_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lessons $lesson, LessonsRepository $lessonsRepository): Response
    {
        $form = $this->createForm(LessonsType::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lessonsRepository->add($lesson, true);

            return $this->redirectToRoute('app_lessons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/lessons/edit.html.twig', [
            'lesson' => $lesson,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lessons_delete', methods: ['POST'])]
    public function delete(Request $request, Lessons $lesson, LessonsRepository $lessonsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lesson->getId(), $request->request->get('_token'))) {
            $lessonsRepository->remove($lesson, true);
        }

        return $this->redirectToRoute('app_lessons_index', [], Response::HTTP_SEE_OTHER);
    }
}