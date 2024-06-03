<?php
namespace App\MessageHandler;

use App\Message\UserRegistered;
use App\Entity\UserEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UserRegisteredHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(UserRegistered $message)
    {
        $userEvent = new UserEvent();
        $userEvent->setUserId($message->getUserId());
        $userEvent->setEmail($message->getEmail());
        $userEvent->setFirstName($message->getFirstName());
        $userEvent->setLastName($message->getLastName());
        $userEvent->setCreatedAt(new \DateTime());

        $this->entityManager->persist($userEvent);
        $this->entityManager->flush();
    }
}
