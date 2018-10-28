<?php
/**
 * Created by PhpStorm.
 * User: mistermed90
 * Date: 10/25/18
 * Time: 12:20 PM
 */

namespace App\Controller;

// Include Dompdf required namespaces
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Student;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Component\HttpFoundation\Request;


class PrintController extends Controller


{


    /**
     * @Route("/{id}/print", name="example_print",methods="GET")
     * @param Student $student
     * @return Response
     */
        public function printPage(Student $student):Response
        {
/*
            $snappy = $this->get('knp_snappy.pdf');

            $html = $this->renderView('student/printedPage.html.twig',
                [
                    'student' => $student,
                ]);

            $filename = 'myPDF';

            return new Response(
                $snappy->getOutputFromHtml($html),
                200,
                array(
                    'Content-Type'          => 'application/pdf',
                    'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
                )
            );*/


        }
}