<?php

namespace App\Controller;

use App\Entity\Quizes;
use App\Entity\Sections;
use App\Entity\Questions;
use App\Entity\Formations;
use App\Form\QuestionsType;
use App\Form\QuizstudenType;
use App\Repository\QuizesRepository;
use App\Repository\SectionsRepository;
use App\Repository\QuestionsRepository;
use App\Repository\FormationsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/quizstuden')]
class QuizstudenController extends AbstractController
{
    
  // #[Security("is_granted('ROLE_INSTRUCTOR')")]
    #[Route('/{id}/edition', name: 'app_quizstuden_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Quizes $quize, QuizesRepository $quizesRepository): Response
    {
        $form = $this->createForm(QuizstudenType::class, $quize);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quizesRepository->add($quize, true);

            return $this->redirectToRoute('app_quizes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/quizstuden/edit.html.twig', [
            'quize' => $quize,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edition2', name: 'app_questions_edit', methods: ['GET', 'POST'])]
    public function edit2(Request $request, Questions $question, QuestionsRepository $questionsRepository): Response
    {
        $form = $this->createForm(QuestionsType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionsRepository->add($question, true);

            return $this->redirectToRoute('app_questions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/quizstuden/edit.html.twig', [
            'question' => $question,
            'form' => $form,
        ]);
    }

    #[Route('/quiz_section', name: 'quizsection', methods: ['GET'])]
    //#[IsGranted('ROLE_USER')]
    public function makequiz(FormationsRepository $formationsRepository, SectionsRepository $sectionsRepository): Response
    {


        /** @var Users $user */
        $user = $this->getUser();
        $formations = $user->getFormations();
        //$sections = $formations->getSections();
        return $this->render('pages/quizstuden/index.html.twig', [
            
            'formations' => $formations,
            //'sections' => $sections,
            
        ]);
    } 

    #[Route('/{id}', name: 'app_correction_show', methods: ['GET'])]
    public function show(Questions $question): Response
    {
        return $this->render('pages/quizstuden/show.html.twig', [
            'question' => $question,
        ]);
    }
}