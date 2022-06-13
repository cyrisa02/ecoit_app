<?php

namespace App\Controller;

use App\Entity\Quizes;
use App\Form\QuizesType;
use App\Repository\QuizesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/quizes')]
class QuizesController extends AbstractController
{
    #[Route('/', name: 'app_quizes_index', methods: ['GET'])]
    public function index(QuizesRepository $quizesRepository): Response
    {
        return $this->render('pages/quizes/index.html.twig', [
            'quizes' => $quizesRepository->findAll(),
        ]);
    }

    #[Route('/creation', name: 'app_quizes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, QuizesRepository $quizesRepository): Response
    {
        $quize = new Quizes();
        $form = $this->createForm(QuizesType::class, $quize);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quizesRepository->add($quize, true);

            return $this->redirectToRoute('app_quizes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/quizes/new.html.twig', [
            'quize' => $quize,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quizes_show', methods: ['GET'])]
    public function show(Quizes $quize): Response
    {
        return $this->render('pages/quizes/show.html.twig', [
            'quize' => $quize,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_quizes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Quizes $quize, QuizesRepository $quizesRepository): Response
    {
        $form = $this->createForm(QuizesType::class, $quize);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quizesRepository->add($quize, true);

            return $this->redirectToRoute('app_quizes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/quizes/edit.html.twig', [
            'quize' => $quize,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quizes_delete', methods: ['POST'])]
    public function delete(Request $request, Quizes $quize, QuizesRepository $quizesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quize->getId(), $request->request->get('_token'))) {
            $quizesRepository->remove($quize, true);
        }

        return $this->redirectToRoute('app_quizes_index', [], Response::HTTP_SEE_OTHER);
    }
}