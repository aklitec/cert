<?php

namespace App\Controller;

use App\Entity\StudyLevel;
use App\Form\StudyLevelType;
use App\Repository\StudyLevelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/study/level")
 */
class StudyLevelController extends AbstractController
{
    /**
     * @Route("/", name="study_level_index", methods="GET")
     */
    public function index(StudyLevelRepository $studyLevelRepository): Response
    {
        return $this->render('study_level/index.html.twig', ['study_levels' => $studyLevelRepository->findAll()]);
    }

    /**
     * @Route("/new", name="study_level_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $studyLevel = new StudyLevel();
        $form = $this->createForm(StudyLevelType::class, $studyLevel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($studyLevel);
            $em->flush();

            return $this->redirectToRoute('study_level_index');
        }

        return $this->render('study_level/new.html.twig', [
            'study_level' => $studyLevel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="study_level_show", methods="GET")
     */
    public function show(StudyLevel $studyLevel): Response
    {
        return $this->render('study_level/show.html.twig', ['study_level' => $studyLevel]);
    }

    /**
     * @Route("/{id}/edit", name="study_level_edit", methods="GET|POST")
     */
    public function edit(Request $request, StudyLevel $studyLevel): Response
    {
        $form = $this->createForm(StudyLevelType::class, $studyLevel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('study_level_edit', ['id' => $studyLevel->getId()]);
        }

        return $this->render('study_level/edit.html.twig', [
            'study_level' => $studyLevel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="study_level_delete", methods="DELETE")
     */
    public function delete(Request $request, StudyLevel $studyLevel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$studyLevel->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($studyLevel);
            $em->flush();
        }

        return $this->redirectToRoute('study_level_index');
    }
}
