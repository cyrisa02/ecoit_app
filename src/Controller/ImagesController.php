<?php

namespace App\Controller;

use App\Entity\Images;
use App\Form\ImagesType;
use App\Repository\ImagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/images')]
class ImagesController extends AbstractController
{
    #[Route('/', name: 'app_images_index', methods: ['GET'])]
    public function index(ImagesRepository $imagesRepository): Response
    {
        return $this->render('pages/images/index.html.twig', [
            'images' => $imagesRepository->findAll(),
        ]);
    }

    #[Route('/creation', name: 'app_images_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ImagesRepository $imagesRepository): Response
    {
        $image = new Images();
        $form = $this->createForm(ImagesType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imagesRepository->add($image, true);

            return $this->redirectToRoute('app_images_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/images/new.html.twig', [
            'image' => $image,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_images_show', methods: ['GET'])]
    public function show(Images $image): Response
    {
        return $this->render('pages/images/show.html.twig', [
            'image' => $image,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_images_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Images $image, ImagesRepository $imagesRepository): Response
    {
        $form = $this->createForm(ImagesType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imagesRepository->add($image, true);

            return $this->redirectToRoute('app_images_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/images/edit.html.twig', [
            'image' => $image,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_images_delete', methods: ['POST'])]
    public function delete(Request $request, Images $image, ImagesRepository $imagesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$image->getId(), $request->request->get('_token'))) {
            $imagesRepository->remove($image, true);
        }

        return $this->redirectToRoute('app_images_index', [], Response::HTTP_SEE_OTHER);
    }
}