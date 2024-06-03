<?php
namespace App\Message;

class UserRegistered
{
    private int $userId;
    private string $email;
    private string $firstName;
    private string $lastName;

    public function __construct(int $userId, string $email, string $firstName, string $lastName)
    {
        $this->userId = $userId;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
}
