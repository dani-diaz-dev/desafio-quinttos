<?php

namespace App\Repositories;

use App\Models\Task;

class StatsRepository
{
    public function countAll(int $userId): int
    {
        return Task::where('user_id', $userId)->count();
    }

    public function countByStatus(int $userId, string $status): int
    {
        return Task::where('user_id', $userId)
            ->where('status', $status)
            ->count();
    }
}
