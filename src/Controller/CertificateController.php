<?php

namespace App\Controller;

use App\Entity\Certificate;
use App\Entity\Student;
use App\Form\CertificateType;
use App\Repository\CertificateRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/certificate")
 */
class CertificateController extends Controller
{

    /**
     * @Route("/", defaults={"page": "1"}, name="certificate_index", methods="GET")
     * @Route("/page/{page<[1-9]\d*>}", name="certificate_index_paginated", methods="GET")
     * @param int $page
     * @param CertificateRepository $repo
     * @return Response
     */
    public function index(int $page, CertificateRepository $repo): Response
    {
        $certificates = $repo->findLatest($page);
        return $this->render('certificate/index.html.twig', ['certificates' => $certificates]);
    }

    /**
     * @Route("/{id}", name="certificate_show", methods="GET")
     * @param Certificate $certificate
     * @return Response
     */
    public function show(Certificate $certificate): Response
    {
        return $this->render('certificate/show.html.twig', ['certificate' => $certificate]);
    }

    /**
     * @Route("/{id}/check", name="certificate_check")
     * @param Student $student
     * @return Response
     */
    public function check(Student $student): ?Response
    {
        $certificate = new Certificate();
        $certificate->setStudent($student);
        $form = $this->createForm(CertificateType::class, $certificate, [
            'action' => $this->generateUrl('certificate_print', ['id' => $student->getId()]),
            'method' => 'POST',
        ]);

        return $this->render('certificate/check.html.twig', [
            'student' => $student,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/print", name="certificate_print")
     * @param Request $request
     * @param Student $student
     * @return Response
     * @throws \Exception
     */
    public function print(Request $request, Student $student): ?Response
    {
        $certificate = new Certificate();
        $certificate->setStudent($student);
        $certificate->setCreatedBy($this->getUser());
        $certificate->setCode(Uuid::uuid4()->toString());
        $certificate->setNumber($this->getNumber());

        $form = $this->createForm(CertificateType::class, $certificate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($certificate);
            $em->flush();

            // Generate HTML and Return Response as a PDF file
            $html = $this->renderView('certificate/certificate.html.twig', array(
                'student' => $student,
                'certificate' => $certificate
            ));
            return new Response(
                $this->get('knp_snappy.pdf')->getOutputFromHtml($html, ['encoding' => 'utf-8']),
                200,
                array(
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="cert_' . $student->getCode() . '.pdf"',
                )
            );
        }

        return $this->render('certificate/print.html.twig', [
            'student' => $student,
            'certificate' => $certificate,
            'form' => $form->createView(),
        ]);
    }

    private function getNumber(){
        $number = 0;
        $em = $this->getDoctrine()->getManager();

        // Get the last inserted row
        $last_row = $em->getRepository(Certificate::class)->findLastInserted();

        // Generate the next number by year
        if($last_row !== null && date('z') !== 0){
            $number = $last_row->getNumber() + 1;
        }

        return $number;
    }
}
