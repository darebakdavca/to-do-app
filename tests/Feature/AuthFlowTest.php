<?php

namespace Tests\Feature;

use App\Models\TaskList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_creates_a_default_private_task_list(): void
    {
        $response = $this->post(route('register.create'), [
            'name' => 'Alice',
            'email' => 'alice@example.com',
            'password1' => 'password123',
            'password2' => 'password123',
        ]);

        $user = User::firstOrFail();
        $taskList = TaskList::firstOrFail();

        $response->assertRedirect(route('task-lists.show', ['task_list' => $taskList]));
        $this->assertAuthenticatedAs($user);

        $this->assertDatabaseHas('users', [
            'email' => 'alice@example.com',
        ]);

        $this->assertDatabaseHas('task_lists', [
            'id' => $taskList->id,
            'name' => 'My tasks',
            'type' => 'private',
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('task_list_user', [
            'task_list_id' => $taskList->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_login_redirects_to_the_users_first_task_list(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $taskList = TaskList::create([
            'name' => 'Inbox',
            'description' => 'Primary list',
            'type' => 'private',
            'user_id' => $user->id,
        ]);

        $user->taskLists()->attach($taskList->id);

        $response = $this->post(route('login.authenticate'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('task-lists.show', ['task_list' => $taskList]));
        $this->assertAuthenticatedAs($user);
    }
}
