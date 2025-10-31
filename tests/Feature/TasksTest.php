<?php

namespace Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    public function test_tasks_can_be_created(): void
    {
        $this->createUserAndLogin();

        $response = $this->post('/tasks', [
           'title' => 'Crear test en el proyecto',
           'description' => 'Crear test de cobertura al CRUD del proyecto',
            'status' => 'pending',
        ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'title' => 'Crear test en el proyecto',
            ]);
    }

    public function test_tasks_can_be_updated(): void
    {
        $user = $this->createUserAndLogin();
        $task = Task::factory()->create();

        $response = $this->put("/tasks/{$task->id}", [
            'id' => $task->id,
            'title' => 'Actualizar test en el proyecto',
            'status' => 'completed',
        ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Actualizar test en el proyecto',
            'status' => 'completed',
        ]);
    }

    public function test_tasks_can_be_deleted(): void
    {
        $user = $this->createUserAndLogin();
        $task = Task::factory()->create();

        $response = $this->delete("/tasks/{$task->id}");

        $response->assertRedirect('/tasks');
        $this->assertSoftDeleted('tasks', ['id' => $task->id]);
    }

    private function createUserAndLogin(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        return $user;
    }
}
