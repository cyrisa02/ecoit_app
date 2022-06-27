<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Lessons;
use App\Form\LessonsType;
use App\Entity\EndedLessons;
use Doctrine\ORM\EntityManager;
use App\Repository\LessonsRepository;
use App\Repository\FormationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EndedLessonsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;



#[Route('/lessons')]
class LessonsController extends AbstractController
{
    #[Route('/', name: 'app_lessons_index', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(LessonsRepository $lessonsRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $lessons = $lessonsRepository->findAll();

        $lessons =$paginator->paginate(
            $lessons,
            
            $request->query->getInt('page', 1),
            1
        );


        return $this->render('pages/lessons/index.html.twig', [
            'lessons' => $lessons,
        ]);
    }

    #[Route('/creation', name: 'app_lessons_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, LessonsRepository $lessonsRepository,SluggerInterface $slugger): Response
    {
        $lesson = new Lessons();
        $form = $this->createForm(LessonsType::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            
            $lessonsRepository->add($lesson, true);

            return $this->redirectToRoute('app_lessons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/lessons/new.html.twig', [
            'lesson' => $lesson,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lessons_show', methods: ['GET'])]
    public function show(Lessons $lesson): Response
    {
        return $this->render('pages/lessons/show.html.twig', [
            'lesson' => $lesson,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_lessons_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lessons $lesson, LessonsRepository $lessonsRepository): Response
    {
        $form = $this->createForm(LessonsType::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lessonsRepository->add($lesson, true);

            return $this->redirectToRoute('app_lessons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/lessons/edit.html.twig', [
            'lesson' => $lesson,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lessons_delete', methods: ['POST'])]
    public function delete(Request $request, Lessons $lesson, LessonsRepository $lessonsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lesson->getId(), $request->request->get('_token'))) {
            $lessonsRepository->remove($lesson, true);
        }

        return $this->redirectToRoute('app_lessons_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/parcours_lessons/{id}', name: 'show_progression')]
    public function showProgression(EndedLessonsRepository $endedLessonsRepository ): Response
    {
        /** @var Users $user */        
        $user= $this->getUser();
        $formations=$user->getFormations();
        $nombredelessons= 0;
        foreach ($formations as $formation) {
            $sections = $formation->getSections();
            foreach ($sections as $section) {
                $nombredelessons += count ($section->getLessons());
            }
        }
        $lessonterminee = count($endedLessonsRepository-> findLessonTermineeByUser($user));

        if ($nombredelessons==0) {
            $progression=0;
        }
        else {$progression = ($lessonterminee * 100) / $nombredelessons;}
        
        return $this->render('pages/lessons/showprogression.html.twig', [
            'progression'=>$progression,
            
        ]);
    }


    

    #[Route('/lesson_terminee/{id}', name: 'app_lessons_end')]
    public function endLesson(Lessons $lesson, EndedLessonsRepository $endedLessonsRepository, EntityManagerInterface $entityManager,FormationsRepository $formationsRepository): Response
    {
        /** @var Users $user */        
        $user= $this->getUser();
         $formations = $user->getFormations();

        $isEnded = $endedLessonsRepository-> findLessonTermineeForThisUser($user, $lesson);


        if ($isEnded) {
            $endedLessonsRepository->remove($isEnded[0], true);
        }
        else {
            /** @var EndedLessons $endedLesson */
            $endedLesson= new EndedLessons();
            $endedLesson->setLessons($lesson);
            $endedLesson->setUsers($user);
            $entityManager->persist($endedLesson);
            $entityManager->flush();
        }
        
        return $this->render('pages/lessons/showcoursebon.html.twig', [
            'lesson' => $lesson,
            'formations' => $formations,
        ]);
    }

    
}