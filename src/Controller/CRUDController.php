<?php

namespace App\Controller;
use App\Entity\UserTesting;
use App\Entity\Address;
use App\Entity\Video;
use App\Form\VideoFormType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CRUDController extends AbstractController
{
    /**
     * @Route("/crud", name="app_crud")
     */
    public function index(): Response
    {

        $entityManager = $this->getDoctrine()->getManager();

        $user = new UserTesting();
        $user->setName('Robert');
        $entityManager->persist($user);
        $entityManager->flush();

        $user1 = new UserTesting();
        $user1->setName('Alex');
        $address = new Address();
        $address->setStreet('street');
        $address->setNumber(109);
        $user1->setAddress($address);

        $entityManager->persist($user1);
        $entityManager->persist($address);
        $entityManager->flush();

        for($i = 1; $i <= 4; $i++) {
            $user2 = new UserTesting();
            $user2->setName('Robert - ' . $i);
            $entityManager->persist($user);
        }

        $entityManager->flush();



        return $this->render('crud/index.html.twig', [
            'controller_name' => 'CRUDController',
        ]);
    }
}
