<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/student")
 */
class StudentController extends AbstractController
{
    /**
     * @Route("/", defaults={"page": "1"}, name="student_index", methods="GET")
     * @Route("/page/{page<[1-9]\d*>}", name="student_index_paginated", methods="GET")
     * @param int $page
     * @param StudentRepository $repo
     * @return Response
     */
    public function index(int $page, StudentRepository $repo): Response
    {
        $students = $repo->findLatest($page);
        return $this->render('student/index.html.twig', ['students' => $students]);
    }

    /**
     * @Route("/new", name="student_new", methods="GET|POST")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();

            return $this->redirectToRoute('student_index');
        }

        return $this->render('student/new.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="student_show", methods="GET")
     * @param Student $student
     * @return Response
     */
    public function show(Student $student): Response
    {
        return $this->render('student/show.html.twig', ['student' => $student]);
    }

    /**
     * @Route("/{id}/edit", name="student_edit", methods="GET|POST")
     * @param Request $request
     * @param Student $student
     * @return Response
     */
    public function edit(Request $request, Student $student): Response
    {
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('student_show', ['id' => $student->getId()]);
        }

        return $this->render('student/edit.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/print", name="student_print", methods="GET|POST")
     * @param Request $request
     * @param Student $student
     * @return Response
     */
    public function print(Request $request, Student $student): Response
    {
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('student_show', ['id' => $student->getId()]);
        }

        return $this->render('student/print.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="student_delete", methods="DELETE")
     * @param Request $request
     * @param Student $student
     * @return Response
     */
    public function delete(Request $request, Student $student): Response
    {
        if ($this->isCsrfTokenValid('delete' . $student->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($student);
            $em->flush();
        }

        return $this->redirectToRoute('student_index');
    }
}
