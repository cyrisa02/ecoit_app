<?php

namespace App\Controller;

use App\Entity\Formations;
use App\Entity\Users;
use App\Form\FormationsType;
use App\Repository\UsersRepository;
use App\Repository\FormationsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/formations')]
class FormationsController extends AbstractController
{
    #[Route('/', name: 'app_formations_index', methods: ['GET'])]
     #[IsGranted('ROLE_USER')]
    public function index(FormationsRepository $formationsRepository): Response
    {
        return $this->render('pages/formations/index.html.twig', [
            'formations' => $formationsRepository->findAll(),
        ]);
    }

    #[Route('/creation', name: 'app_formations_new', methods: ['GET', 'POST'])]
 // #[Security("is_granted('ROLE_INSTRUCTOR') and user === formation.getUsers()")]
    public function new(Request $request, FormationsRepository $formationsRepository): Response
    {
        $formation = new Formations();
        $form = $this->createForm(FormationsType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formationsRepository->add($formation, true);

            $this->addFlash(
                'success',
                'Votre formation a été créée avec succès !'
            );



            return $this->redirectToRoute('app_formations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/formations/new.html.twig', [
            'formation' => $formation,
            'form' => $form,
        ]);
    }

  #[Security("is_granted('ROLE_INSTRUCTOR') ")]
    #[Route('/{id}', name: 'app_formations_show', methods: ['GET'])]
    public function show(Formations $formation): Response
    {
        return $this->render('pages/formations/show.html.twig', [
            'formation' => $formation,
            
        ]);
    }

    #[Security("is_granted('ROLE_INSTRUCTOR')")]
    #[Route('/{id}/edition', name: 'app_formations_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Formations $formation, FormationsRepository $formationsRepository): Response
    {
        $form = $this->createForm(FormationsType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formationsRepository->add($formation, true);
            $this->addFlash(
                'success',
                'Votre formation a été modifiée avec succès !'
            );


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