<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class FeatureTodoDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function testDeleteExistingTask()
    {
        // Buat data task baru
        $task = Task::create([
            'name' => 'Task to Delete',
            'is_done' => false,
        ]);

        // Request delete ke route dengan id task
        $response = $this->delete(route('item.destroy', ['id' => $task->id]));

        // Pastikan response redirect ke dashboard
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('dashboard'));

        // Pastikan data task sudah tidak ada di database
        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    public function testDeleteNonExistingTask()
    {
        $nonExistingId = 9999;

        $response = $this->delete(route('item.destroy', ['id' => $nonExistingId]));

        // Misal aplikasi redirect ke dashboard dengan session error
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('error');
    }
}
