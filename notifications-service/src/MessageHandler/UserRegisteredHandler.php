<?php
namespace App\MessageHandler;

use App\Message\UserRegistered;
use App\Entity\Notification;
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
        $notification = new Notification();
        $notification->setUserId($message->getUserId());
        $notification->setEmail($message->getEmail());
        $notification->setFirstName($message->getFirstName());
        $notification->setLastName($message->getLastName());
        $notification->setCreatedAt(new \DateTime());

        $this->entityManager->persist($notification);
        $this->entityManager->flush();
    }
}
