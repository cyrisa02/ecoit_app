<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * This controller displays the RGPD
 */

class RGPDController extends AbstractController
{
    #[Route('/rgpd', name: 'rgpd', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('pages/rgpd.html.twig');
    }
}