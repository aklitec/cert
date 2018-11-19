<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/", name="cert")
 */
class LoginController extends Controller
{

    /**
     * @Route("/login_aa", name="login")
     */
    public function loginPage(Request $request)
    {
        $user = $this->getUser();
        if ($user instanceof UserInterface) {
            return $this->redirectToRoute('student');
        }
        /** @var AuthenticationException $exception */
        $exception = $this->get('security.authentication_utils')
            ->getLastAuthenticationError();

        return $this->render('login/login.html.twig', [
            'error' => $exception ? $exception->getMessage() : NULL,
        ]);

    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
    }
}
