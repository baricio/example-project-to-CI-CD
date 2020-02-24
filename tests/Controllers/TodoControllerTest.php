<?php

namespace Tests\Controllers;

use App\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_list_of_tasks()
    {
        factory(Todo::class, 20)->create();
        $response = $this->get('/api/todos');

        $response
            ->assertStatus(200)
            ->assertJsonCount(15, 'data.*');
    }

    public function test_create_task()
    {
        $response = $this->post('/api/todos', [
            'task' => 'new task'
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'task' => 'new task'
            ]);
    }

    public function test_update_task()
    {
        $task = factory(Todo::class)->create([
            'task' => 'old task'
        ]);

        $response = $this->put('/api/todos/' . $task->id, [
            'task' => 'updated task'
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'id' => $task->id,
                'task' => 'updated task'
            ]);
    }

    public function test_delete_task()
    {
        $task = factory(Todo::class)->create([
            'task' => 'task to delete'
        ]);

        $response = $this->delete('/api/todos/' . $task->id);

        $response
            ->assertStatus(200);
    }
}
