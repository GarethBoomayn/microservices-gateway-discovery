<?php
// ms-article/symfony/src/Controller/ArticleController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{
    #[Route('/articles', name: 'article_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        // Dummy data for demonstration
        $articles = [
            ['id' => 1, 'title' => 'First Article', 'content' => 'Content of the first article.'],
            ['id' => 2, 'title' => 'Second Article', 'content' => 'Content of the second article.'],
        ];
        return new JsonResponse($articles);
    }

    #[Route('/articles/{id}', name: 'article_show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        // Dummy article data for demonstration
        $article = ['id' => $id, 'title' => "Article $id", 'content' => "Content for article $id"];
        return new JsonResponse($article);
    }

    #[Route('/articles', name: 'article_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        // Decode the incoming JSON payload
        $data = json_decode($request->getContent(), true);
        // Simulate creation by returning the data with a new random ID
        $article = [
            'id'      => rand(100, 999),
            'title'   => $data['title'] ?? 'No Title',
            'content' => $data['content'] ?? 'No Content'
        ];
        return new JsonResponse($article, 201);
    }
}
