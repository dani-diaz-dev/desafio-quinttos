<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService
{
    public function __construct(
        protected TaskRepository $taskRepository,
    )
    {
    }

    public function getAllTasks(array $filters = []): \Illuminate\Database\Eloquent\Collection
    {
        return $this->taskRepository->getAll($filters);
    }
}
