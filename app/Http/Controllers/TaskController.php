<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskFilterRequest;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService  $taskService,
    )
    {
    }

    public function index(TaskFilterRequest $request)
    {
        $tasks = $this->taskService->getAllTasks($request->only(['status', 'title']));
        return view('tasks.index', compact('tasks'));
    }
}
