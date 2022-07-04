<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ContactTest extends WebTestCase
{
    public function testIfSubmitContactFormIsSuccessfull(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/inscription_instructeur');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Formulaire d\'inscription instructeur');

        //Récupérer le formaulaire
        $submitButton = $crawler->selectButton(('Soumettre ma demande'));
        $form = $submitButton->form();

        $form["registration_form[lastname]"]="Doe";
        $form["registration_form[firstname]"]="John";
        $form["registration_form[email]"]="johndoe@email";
        $form["registration_form[decription]"]="Etudiant";
        $form["registration_form[pseudo]"]="Doe";
       // $form["registration_form[is_verified]"]="true";
      //  $form["registration_form[is_validInstructor]"]="true";
       // $form["registration_form[plainPassword]"]="azerty";

        
        //Soumettre le formulaire
        $client->submit($form);

        //Vérifier le statut HTTP
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);       

        // Vérifier l'envoi du mail
        //$this->assertEmailCount(1);

       // $client->followRedirect();

       // renvoie d'un message de succès
       // $this->assertSelectorTextContains(
      //  'div.alert.alert-success.mt-4',
       // 'Votre demande a été envoyée avec succès');
       


    }
}