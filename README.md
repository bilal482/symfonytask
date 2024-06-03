# Microservices Application with Users and Notifications

This application consists of two microservices: `users` and `notifications`. The `users` service handles user creation and dispatches events to the `notifications` service via a message bus. The `notifications` service consumes these events and stores the notifications in a database.

## Prerequisites

- Docker
- Docker Compose

## Setup

1. **Clone the repository:**

   ```sh
   git clone https://github.com/bilal482/symfonytask.git
   cd symfonytask

2. Add the project path in docker references, and restart the docker

3. **Run the Docker command**
    docker-compose up --build

4. **Run database migrations for the database schema**
    docker-compose exec users-service php bin/console doctrine:schema:update --force
    docker-compose exec notifications-service php bin/console doctrine:schema:update --force

5. **Run the Notifications**
    docker-compose exec notifications-service php bin/console messenger:consume async --env=prod


DOD for and above CQRS
symfonytask/
├── users-service/
│   ├── src/
│   │   ├── Controller/
│   │   │       └── UserController.php
│   │   ├── Entity/
│   │   │   └── User.php
│   │   │   └── UserEvent.php
│   │   ├── Message/
│   │   │   └── UserRegistered.php
│   │   ├── MessageHandler/
│   │   │    └── UserRegisteredHandler.php
│   │   ├── Repository/
│   │    └── UserRepository.php
│   ├── config/
│   │   ├── packages/
│   │   ├── routes/
│   │   ├── services.yaml
│   ├── public/
│   ├── composer.json
│   ├── Dockerfile
│   ├── .env
├── notifications-service/
│   ├── src/
│   │   ├── Controller/
│   │   ├── Entity/
│   │   │   └── Notification.php
│   │   ├── Message/
│   │   │   └── UserRegistered.php
│   │   ├── MessageHandler/
│   │   │    └── UserRegisteredHandler.php
│   │   ├── Repository/
│   ├── config/
│   │   ├── packages/
│   │   ├── routes/
│   │   ├── services.yaml
│   ├── public/
│   ├── composer.json
│   ├── Dockerfile
│   ├── .env
├──  docker-compose.yml


This is the majore DOD,