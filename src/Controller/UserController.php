<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;


class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    public function submit(Request $request, SerializerInterface $serializer, EntityManagerInterface $em) : Response
    {
        // Create a User instance from JSON
        $user = $serializer->deserialize($request->getContent(), User::class, 'json');

         // Do with your user whatever you like, usually persist it.
         $em->persist($user);
         $em->flush();

         // Refresh the shelf
        $em->refresh($user->getShelf());

        // Dump user
        dump($user);

        // Dump shelf and show it's users
        dump($user->getShelf());
        dump($user->getShelf()->getusers()->toArray());

        return new Response('', Response::HTTP_OK);

    }

}
