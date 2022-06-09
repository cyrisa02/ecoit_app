<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * This controller displays the CVG
 */
class CVGController extends AbstractController
{
    #[Route('cvg', name: 'cvg')]
    public function index(): Response
    {
        return $this->render('pages/cvg.html.twig');
    }
}