<?php
// ms-author/symfony/src/Controller/AuthorController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController
{
    #[Route('/authors', name: 'author_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        // Dummy list of authors
        $authors = [
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
            ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com'],
        ];
        return new JsonResponse($authors);
    }

    #[Route('/authors/{id}', name: 'author_show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        // Dummy data for a single author
        $author = ['id' => $id, 'name' => "Author $id", 'email' => "author$id@example.com"];
        return new JsonResponse($author);
    }

    #[Route('/authors', name: 'author_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $author = [
            'id'    => rand(100, 999),
            'name'  => $data['name'] ?? 'No Name',
            'email' => $data['email'] ?? 'No Email'
        ];
        return new JsonResponse($author, 201);
    }
}
