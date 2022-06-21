<?php

namespace App\Controller;


use App\Entity\Formations;
use App\Repository\FormationsRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * This controller displays the course for the formation
 */

class LearningController extends AbstractController
{
   #[Route('/apprenant_sections', name: 'learningsection', methods: ['GET'])]
    //#[IsGranted('ROLE_USER')]
    public function course(FormationsRepository $formationsRepository): Response
    {


        /** @var Users $user */
        $user = $this->getUser();
        $formations = $user->getFormations();
        return $this->render('pages/learning/index.html.twig', [
            
            'formations' => $formations,
            
        ]);
    } 

}