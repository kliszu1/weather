<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Description of SecurityController
 *
 * @author Kliszu
 */

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="weather")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/", name="weather")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
