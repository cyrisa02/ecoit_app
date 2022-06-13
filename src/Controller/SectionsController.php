<?php

namespace App\Controller;

use App\Entity\Sections;
use App\Form\SectionsType;
use App\Repository\SectionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sections')]
class SectionsController extends AbstractController
{
    #[Route('/', name: 'app_sections_index', methods: ['GET'])]
    public function index(SectionsRepository $sectionsRepository): Response
    {
        return $this->render('pages/sections/index.html.twig', [
            'sections' => $sectionsRepository->findAll(),
        ]);
    }

    #[Route('/creation', name: 'app_sections_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SectionsRepository $sectionsRepository): Response
    {
        $section = new Sections();
        $form = $this->createForm(SectionsType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sectionsRepository->add($section, true);

            return $this->redirectToRoute('app_sections_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/sections/new.html.twig', [
            'section' => $section,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sections_show', methods: ['GET'])]
    public function show(Sections $section): Response
    {
        return $this->render('pages/sections/show.html.twig', [
            'section' => $section,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_sections_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sections $section, SectionsRepository $sectionsRepository): Response
    {
        $form = $this->createForm(SectionsType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sectionsRepository->add($section, true);

            return $this->redirectToRoute('app_sections_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/sections/edit.html.twig', [
            'section' => $section,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sections_delete', methods: ['POST'])]
    public function delete(Request $request, Sections $section, SectionsRepository $sectionsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$section->getId(), $request->request->get('_token'))) {
            $sectionsRepository->remove($section, true);
        }

        return $this->redirectToRoute('app_sections_index', [], Response::HTTP_SEE_OTHER);
    }
}