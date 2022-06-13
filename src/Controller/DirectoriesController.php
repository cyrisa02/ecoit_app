<?php

namespace App\Controller;

use App\Entity\Directories;
use App\Form\DirectoriesType;
use App\Repository\DirectoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/catalogues')]
class DirectoriesController extends AbstractController
{
    #[Route('/', name: 'app_directories_index', methods: ['GET'])]
    public function index(DirectoriesRepository $directoriesRepository): Response
    {
        return $this->render('pages/directories/index.html.twig', [
            'directories' => $directoriesRepository->findAll(),
        ]);
    }

    #[Route('/creation', name: 'app_directories_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DirectoriesRepository $directoriesRepository): Response
    {
        $directory = new Directories();
        $form = $this->createForm(DirectoriesType::class, $directory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $directoriesRepository->add($directory, true);

            return $this->redirectToRoute('app_directories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/directories/new.html.twig', [
            'directory' => $directory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_directories_show', methods: ['GET'])]
    public function show(Directories $directory): Response
    {
        return $this->render('pages/directories/show.html.twig', [
            'directory' => $directory,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_directories_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Directories $directory, DirectoriesRepository $directoriesRepository): Response
    {
        $form = $this->createForm(DirectoriesType::class, $directory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $directoriesRepository->add($directory, true);

            return $this->redirectToRoute('app_directories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/directories/edit.html.twig', [
            'directory' => $directory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_directories_delete', methods: ['POST'])]
    public function delete(Request $request, Directories $directory, DirectoriesRepository $directoriesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$directory->getId(), $request->request->get('_token'))) {
            $directoriesRepository->remove($directory, true);
        }

        return $this->redirectToRoute('app_directories_index', [], Response::HTTP_SEE_OTHER);
    }
}