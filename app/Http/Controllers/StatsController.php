<?php

namespace App\Http\Controllers;

use App\Services\StatsService;
use Illuminate\Support\Facades\Auth;

class StatsController extends Controller
{
    public function __construct(
        protected StatsService $statsService
    )
    {
    }

    public function index()
    {
        try {
            $userId = Auth::id();
            $stats = $this->statsService->getUserStats($userId);
            return view('stats.index', compact('stats'));
        } catch (\Throwable $e) {
            return redirect()->route('home')
                ->with('error', 'No se pudieron cargar las estadísticas.');
        }
    }
}
