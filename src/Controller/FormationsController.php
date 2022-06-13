<?php

namespace App\Controller;

use App\Entity\Formations;
use App\Form\FormationsType;
use App\Repository\FormationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/formations')]
class FormationsController extends AbstractController
{
    #[Route('/', name: 'app_formations_index', methods: ['GET'])]
    public function index(FormationsRepository $formationsRepository): Response
    {
        return $this->render('pages/formations/index.html.twig', [
            'formations' => $formationsRepository->findAll(),
        ]);
    }

    #[Route('/creation', name: 'app_formations_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FormationsRepository $formationsRepository): Response
    {
        $formation = new Formations();
        $form = $this->createForm(FormationsType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formationsRepository->add($formation, true);

            return $this->redirectToRoute('app_formations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/formations/new.html.twig', [
            'formation' => $formation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formations_show', methods: ['GET'])]
    public function show(Formations $formation): Response
    {
        return $this->render('pages/formations/show.html.twig', [
            'formation' => $formation,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_formations_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Formations $formation, FormationsRepository $formationsRepository): Response
    {
        $form = $this->createForm(FormationsType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formationsRepository->add($formation, true);

            return $this->redirectToRoute('app_formations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/formations/edit.html.twig', [
            'formation' => $formation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formations_delete', methods: ['POST'])]
    public function delete(Request $request, Formations $formation, FormationsRepository $formationsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formation->getId(), $request->request->get('_token'))) {
            $formationsRepository->remove($formation, true);
        }

        return $this->redirectToRoute('app_formations_index', [], Response::HTTP_SEE_OTHER);
    }
}