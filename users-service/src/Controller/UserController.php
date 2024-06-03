<?php
namespace App\Controller;

use App\Entity\User;
use App\Message\UserRegistered;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\MessageBusInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/users", name="create_user", methods={"POST"})
     */
    public function createUser(Request $request, EntityManagerInterface $entityManager, MessageBusInterface $messageBus): Response
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['email'], $data['firstName'], $data['lastName'])) {
            return new JsonResponse(['error' => 'Invalid input'], Response::HTTP_BAD_REQUEST);
        }

        $user = new User();
        $user->setEmail($data['email']);
        $user->setFirstName($data['firstName']);
        $user->setLastName($data['lastName']);

        try {
            $entityManager->persist($user);
            $entityManager->flush();

            $messageBus->dispatch(new UserRegistered($user->getId(), $user->getEmail(), $user->getFirstName(), $user->getLastName()));

            return new JsonResponse(['message' => 'User created', 'id' => $user->getId()], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Could not save user', 'details' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
