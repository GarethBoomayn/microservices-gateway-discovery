<?php
// ms-user/symfony/src/Controller/UserController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    #[Route('/users', name: 'user_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        // Dummy list of users
        $users = [
            ['id' => 1, 'username' => 'user1', 'email' => 'user1@example.com'],
            ['id' => 2, 'username' => 'user2', 'email' => 'user2@example.com'],
        ];
        return new JsonResponse($users);
    }

    #[Route('/users/{id}', name: 'user_show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        // Dummy data for a single user
        $user = ['id' => $id, 'username' => "user$id", 'email' => "user$id@example.com"];
        return new JsonResponse($user);
    }

    #[Route('/users', name: 'user_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = [
            'id'       => rand(100, 999),
            'username' => $data['username'] ?? 'defaultUser',
            'email'    => $data['email'] ?? 'default@example.com'
        ];
        return new JsonResponse($user, 201);
    }
}
