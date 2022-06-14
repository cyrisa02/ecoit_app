<?php

namespace App\Controller;

use App\Entity\Ressources;
use App\Form\RessourcesType;
use App\Repository\RessourcesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/ressources')]
class RessourcesController extends AbstractController
{
    #[Route('/', name: 'app_ressources_index', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(RessourcesRepository $ressourcesRepository): Response
    {
        return $this->render('pages/ressources/index.html.twig', [
            'ressources' => $ressourcesRepository->findAll(),
        ]);
    }

    #[Route('/creation', name: 'app_ressources_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, RessourcesRepository $ressourcesRepository): Response
    {
        $ressource = new Ressources();
        $form = $this->createForm(RessourcesType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ressourcesRepository->add($ressource, true);

            return $this->redirectToRoute('app_ressources_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/ressources/new.html.twig', [
            'ressource' => $ressource,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ressources_show', methods: ['GET'])]
    public function show(Ressources $ressource): Response
    {
        return $this->render('pages/ressources/show.html.twig', [
            'ressource' => $ressource,
        ]);
    }
    
    //#[Security("is_granted('ROLE_USER') and user === formation.getUsers()")]
    #[Route('/{id}/edition', name: 'app_ressources_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ressources $ressource, RessourcesRepository $ressourcesRepository): Response
    {
        $form = $this->createForm(RessourcesType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ressourcesRepository->add($ressource, true);

            return $this->redirectToRoute('app_ressources_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/ressources/edit.html.twig', [
            'ressource' => $ressource,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ressources_delete', methods: ['POST'])]
    public function delete(Request $request, Ressources $ressource, RessourcesRepository $ressourcesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ressource->getId(), $request->request->get('_token'))) {
            $ressourcesRepository->remove($ressource, true);
        }

        return $this->redirectToRoute('app_ressources_index', [], Response::HTTP_SEE_OTHER);
    }
}