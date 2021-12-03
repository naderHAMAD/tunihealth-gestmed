<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render('home/about.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/services", name="services")
     */
    public function services(): Response
    {
        return $this->render('home/services.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/doctors", name="doctors")
     */
    public function doctors(): Response
    {
        return $this->render('home/doctors.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
     /**
     * @Route("/blog", name="blog")
     */
    public function blog(): Response
    {
        return $this->render('home/blog.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
     /**
     * @Route("/blogsingle", name="blogsingle")
     */
    public function blogsingle(): Response
    {
        return $this->render('home/blogsingle.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/register", name="register")
     */
    public function register(): Response
    {
        return $this->render('home/register.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
     /**
     * @Route("/login", name="login")
     */
    public function login(): Response
    {
        return $this->render('home/login.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


}
