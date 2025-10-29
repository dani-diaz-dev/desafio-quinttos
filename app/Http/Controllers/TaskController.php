<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\TaskFilterRequest;
use App\Services\TaskService;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $taskService,
    )
    {
    }

    public function index(TaskFilterRequest $request)
    {
        $tasks = $this->taskService->getAllTasks($request->only(['status', 'title']));
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(CreateTaskRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->taskService->createTask($request->validated());
            DB::commit();

            return redirect()
                ->route('tasks.index')
                ->with('success', 'Tarea creada correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Ocurrió un error al crear la tarea.');
        }
    }
}
