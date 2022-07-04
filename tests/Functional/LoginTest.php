<?php

namespace App\Tests\Functional;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginTest extends WebTestCase
{
    public function testIfLoginIsSuccessfull(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/connexion');

        //Form
        $submitButton = $crawler->selectButton(('Soumettre ma demande'));
        $form = $submitButton->form();

        $form["email"]="alice.g@gmail.com";
        $form["password"]="azerty";

       //Soumettre le formulaire
         $client->submit($form);

        //Vérifier le statut HTTP
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);    

        $client->followRedirect();

        $this->assertRouteSame('home.index');
        
    }

    public function testIfLoginFailedWhenPasswordIsWrong(): void
    {

        $client = static::createClient();
        $crawler = $client->request('GET', '/connexion');

        //Form
        $submitButton = $crawler->selectButton(('Soumettre ma demande'));
        $form = $submitButton->form();

        $form["email"]="alice.g@gmail.com";
        $form["password"]="azerty_";

       //Soumettre le formulaire
         $client->submit($form);

        //Vérifier le statut HTTP
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);    

        $client->followRedirect();

        $this->assertRouteSame('app_login');

        $this->assertSelectorTextContains("div.alert-danger", "Invalid credentials.");
    }
}