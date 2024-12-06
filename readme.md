<?php

namespace App\Controller\Api;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/tasks')]
class TaskController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // 1. Lister toutes les tâches
    #[Route('', name: 'api_tasks_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $tasks = $this->entityManager->getRepository(Task::class)->findAll();
        $data = array_map(function (Task $task) {
            return [
                'id' => $task->getId(),
                'name' => $task->getName(),
                'status' => $task->getStatus(),
            ];
        }, $tasks);

        return $this->json($data);
    }

    // 2. Créer une nouvelle tâche
    #[Route('', name: 'api_tasks_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (empty($data['name']) || empty($data['status'])) {
            return $this->json(['error' => 'Invalid data'], 400);
        }

        $task = new Task();
        $task->setName($data['name']);
        $task->setStatus($data['status']);

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return $this->json([
            'message' => 'Task created successfully',
            'task' => [
                'id' => $task->getId(),
                'name' => $task->getName(),
                'status' => $task->getStatus(),
            ],
        ], 201);
    }

    // 3. Mettre à jour une tâche existante
    #[Route('/{id}', name: 'api_tasks_update', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $task = $this->entityManager->getRepository(Task::class)->find($id);

        if (!$task) {
            return $this->json(['error' => 'Task not found'], 404);
        }

        if (!empty($data['name'])) {
            $task->setName($data['name']);
        }

        if (!empty($data['status'])) {
            $task->setStatus($data['status']);
        }

        $this->entityManager->flush();

        return $this->json([
            'message' => 'Task updated successfully',
            'task' => [
                'id' => $task->getId(),
                'name' => $task->getName(),
                'status' => $task->getStatus(),
            ],
        ]);
    }

    // 4. Supprimer une tâche
    #[Route('/{id}', name: 'api_tasks_delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $task = $this->entityManager->getRepository(Task::class)->find($id);

        if (!$task) {
            return $this->json(['error' => 'Task not found'], 404);
        }

        $this->entityManager->remove($task);
        $this->entityManager->flush();

        return $this->json(['message' => 'Task deleted successfully']);
    }
}
