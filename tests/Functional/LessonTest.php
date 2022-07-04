<?php

namespace App\Tests\Functional;

use App\Entity\Lessons;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonTest extends WebTestCase
{
    public function testIfCreateLessonIsSuccessfull(): void
    {
        $client = static::createClient();

        //Recup urlgenerator
        $urlGenerator = $client->getContainer()->get('router');
        

        //Recup entity manager et récupérer le user
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(Users::class,1);

        $client->loginUser($user);
        //Se rendre sur la page de création d'une leçon

        $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('app_lessons_new'));

        //Gérer le formulaire
        $form = $crawler->filter('form[name=lesson]')->form([
            'lesson[title]'=> "Une leçon",
            'lesson[description]'=> "Une description",
        ]);


        $client->submit($form);      
        
        //Gérer la redirection
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);    

        $client->followRedirect();

        //Gérer l'alert box et la route

        //$this->assertSelectorTextContains('div.alert-success', 'Leçon bien créée');

        $this->assertRouteSame('app_lessons_index');
    }


        public function testIfListLessonsIsSuccessfull():void
        {
           $client = static::createClient();

        //Recup urlgenerator
        $urlGenerator = $client->getContainer()->get('router');
        

        //Recup entity manager et récupérer le user
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(Users::class,1);

        $client->loginUser($user);
        //Se rendre sur la page de création d'une leçon

        $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('app_lessons_index'));

        $this->assertResponseIsSuccessful();

        $this->assertRouteSame('app_lessons_index');

        }



        public function testIfUpdateAnLessonIsSuccessfull():void
        {
            $client = static::createClient();

        //Recup urlgenerator
        $urlGenerator = $client->getContainer()->get('router');
        

        //Recup entity manager et récupérer le user
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(Users::class,1);
        $lesson = $entityManager->getRepository(Lessons::class)->findOneBy([
            'user' => $user
        ]);

        $client->loginUser($user);
       
        $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('app_lessons_edit', ['id'=> $lesson->getId()]));

        $this->assertResponseIsSuccessful();



        //Gérer le formulaire
        $form = $crawler->filter('form[name=lesson]')->form([
            'lesson[title]'=> "Une leçon n° 2",
            'lesson[description]'=> "Une description n°2",
        ]);


        $client->submit($form);      
        
        //Gérer la redirection
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);    

        $client->followRedirect();

        //Gérer l'alert box et la route

        //$this->assertSelectorTextContains('div.alert-success', 'Leçon bien créée');

        $this->assertRouteSame('app_lessons_index');

        }


        public function testIfDeleteAnLessonIsSuccessfull():void
        {
             $client = static::createClient();

        //Recup urlgenerator
        $urlGenerator = $client->getContainer()->get('router');
        

        //Recup entity manager et récupérer le user
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(Users::class,1);
        $lesson = $entityManager->getRepository(Lessons::class)->findOneBy([
            'user' => $user
        ]);

        $client->loginUser($user);
       
        $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('app_lessons_delete', ['id'=> $lesson->getId()]));

         //Gérer la redirection
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);    

        $client->followRedirect();

        //Gérer l'alert box et la route

        //$this->assertSelectorTextContains('div.alert-success', 'Leçon bien supprimée');

        $this->assertRouteSame('app_lessons_index');

        }

        
    
}