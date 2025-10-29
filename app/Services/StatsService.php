<?php

namespace App\Services;

use App\Repositories\StatsRepository;

class StatsService
{
    public function __construct(
        protected StatsRepository $statsRepository
    )
    {
    }

    public function getUserStats(int $userId): array
    {
        $total = $this->statsRepository->countAll($userId);
        $completed = $this->statsRepository->countByStatus($userId, 'completed');
        $pending = $this->statsRepository->countByStatus($userId, 'pending');

        $percent = $total > 0 ? round(($completed / $total) * 100, 2) : 0;

        return compact('total', 'completed', 'pending', 'percent');
    }
}
