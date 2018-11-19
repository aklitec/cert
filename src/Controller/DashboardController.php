<?php

namespace App\Controller;

use App\Entity\Certificate;
use App\Entity\Student;
use App\Entity\User;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function index()
    {
        // Students stats
        $repo = $this->getDoctrine()->getRepository(Student::class);
        $students_count = $repo->count(['deleted' => 0]);
        $students_latest = $repo->latest();

        // Certificates stats
        $repo = $this->getDoctrine()->getRepository(Certificate::class);
        $certificates_count = $repo->count([]);
        $certificates_latest = $repo->latest();

        // Users stats
        $repo = $this->getDoctrine()->getRepository(User::class);
        $users_count = $repo->count([]);
        $users_latest = $repo->latestConnected();

        return $this->render('dashboard/index.html.twig', [
            'students' => ['count' => $students_count, 'latest' => $students_latest],
            'certificates' => ['count' => $certificates_count, 'latest' => $certificates_latest],
            'users' => ['count' => $users_count, 'latest' => $users_latest],
            'controller_name' => 'DashboardController',
        ]);
    }
}
