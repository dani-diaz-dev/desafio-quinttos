<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskService
{
    public function __construct(
        protected TaskRepository $taskRepository,
    )
    {
    }

    public function getAllTasks(array $filters = []): \Illuminate\Database\Eloquent\Collection
    {
        $filters['user_id'] = auth()->id();
        return $this->taskRepository->getAll($filters);
    }

    public function createTask(array $data)
    {
        $data['user_id'] = auth()->id();
        return $this->taskRepository->create($data);
    }

    public function getTaskById(int $id)
    {
        $task = $this->taskRepository->findById($id);

        if (!$task) {
            throw new ModelNotFoundException("Tarea no encontrada");
        }

        return $task;
    }

    public function updateTask(array $data)
    {
        $task = $this->taskRepository->findById($data['id']);

        if (!$task) {
            throw new \Exception('Tarea no encontrada');
        }

        return $this->taskRepository->update($task, $data);
    }

    public function deleteTask(int $id): bool
    {
        $task = $this->taskRepository->findById($id);

        if (!$task) {
            throw new \Exception('Tarea no encontrada');
        }

        return $this->taskRepository->delete($task);
    }
}
