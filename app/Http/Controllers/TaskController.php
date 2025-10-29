<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\TaskFilterRequest;
use App\Http\Requests\TaskIdRequest;
use App\Http\Requests\UpdateTaskRequest;
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

    public function edit($id)
    {
        try {
            $task = $this->taskService->getTaskById($id);
            return response()->json($task);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'No se encontró la tarea.'], 404);
        }
    }

    public function update(UpdateTaskRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->taskService->updateTask($request->all());

            DB::commit();
            return redirect()
                ->route('tasks.index')
                ->with('success', 'Tarea actualizada correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Error al actualizar tarea: ' . $e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Ocurrió un error al actualizar la tarea.');
        }
    }

    public function destroy(TaskIdRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->taskService->deleteTask($request->input('id'));

            DB::commit();
            return redirect()
                ->route('tasks.index')
                ->with('success', 'Tarea eliminada correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Error al eliminar tarea: ' . $e->getMessage());
            return redirect()
                ->route('tasks.index')
                ->with('error', 'No se pudo eliminar la tarea.');
        }
    }
}
