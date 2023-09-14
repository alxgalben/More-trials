<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends AbstractController
{
    //--------------------------------------------------------------------------------------------------------
    /**
     * @Route("/default", name="app_default")
     */
    public function index(): Response
    {
        //return $this->json(['username' => 'john.doe']);
        //return new Response("Hello Guys.");
        //return new Response("Hello $name"); // dynamic parameter
        //return $this -> redirect("http://symfony.com");
        //return $this -> redirectToRoute('default2');

        $users = ['Alex', 'Theo', 'Sergiu'];
        //$users = $this -> getDoctrine() -> getRepository(User::class) -> findAll();

        // $user = new User;
        // $user -> setName('Adam');
        // $user1 = new User;
        // $user1 -> setName('Theo');
        // $user2 = new User;
        // $user2 -> setName('Sergiu');
        // $entityManager -> persist($user);
        // $entityManager -> persist($user1);
        // $entityManager -> persist($user2);
        // $entityManager -> flush();


        return $this -> render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users
        ]);

    }

    //--------------------------------------------------------------------------------------------------------

    /**
     * @Route("/default2/{name}", name="default2")
     */

    public function index2($name) {
        return new Response("Hi $name , I am from default2 route.");
    }

    //--------------------------------------------------------------------------------------------------------
    /**
     * @Route("/generate-url/{param?}", name = "generate_url")
     */

     public function generate_url() {
        exit($this->generateUrl(
            'generate_url',
            array('param' => 10),
            UrlGeneratorInterface::ABSOLUTE_URL
        ));
     }

     //--------------------------------------------------------------------------------------------------------
     /**
     * @Route("/download")
     */

     public function download() {
        $path = $this -> getParameter('download_directory');
        return $this -> file($path.'file.pdf');
     }

     //--------------------------------------------------------------------------------------------------------

     /**
     * @Route("/redirect-test")
     */

     public function redirectTest() {
        return $this -> redirectToRoute('route_to_redirect', array('param' => 10)
    );
     }

     //--------------------------------------------------------------------------------------------------------

     /**
     * @Route("/url-to-redirect/{param?}", name="route_to_redirect")
     */

     public function methodToRedirect() {
        exit('Test redirection');
     }

     //--------------------------------------------------------------------------------------------------------

      /**
     * @Route("/forwarding-to-controller")
     */

    public function forwardingToController()
    {
        $response = $this->forward(
            'App\Controller\DefaultController::methodToForwardTo',
            array('param'  => '1')
          );
        return $response;
    }

    //--------------------------------------------------------------------------------------------------------

     /**
     * @Route("/url-to-forward-to/{param?}", name="route_to_forward_to")
     */
    public function methodToForwardTo($param)
    {
        exit('Test controller forwarding - '.$param);
    }

}
