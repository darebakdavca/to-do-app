<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_update_complete_and_delete_a_shared_task(): void
    {
        $owner = User::factory()->create();
        $assignee = User::factory()->create();

        $taskList = TaskList::create([
            'name' => 'Team Board',
            'description' => 'Shared work',
            'type' => 'shared',
            'user_id' => $owner->id,
        ]);

        $taskList->users()->attach([$owner->id, $assignee->id]);

        $createResponse = $this
            ->actingAs($owner)
            ->post(route('tasks.store'), [
                'name' => 'Draft launch checklist',
                'description' => 'Prepare the release checklist',
                'due_date' => '2026-04-01',
                'task_list_id' => $taskList->id,
                'assignees' => [$owner->id, $assignee->id],
            ]);

        $task = Task::firstOrFail();

        $createResponse->assertRedirect(route('task-lists.show', ['task_list' => $taskList]));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'task_list_id' => $taskList->id,
            'name' => 'Draft launch checklist',
            'due_date' => '2026-04-01',
            'complete' => false,
        ]);

        $this->assertDatabaseHas('task_user', [
            'task_id' => $task->id,
            'user_id' => $owner->id,
        ]);

        $this->assertDatabaseHas('task_user', [
            'task_id' => $task->id,
            'user_id' => $assignee->id,
        ]);

        $updateResponse = $this
            ->actingAs($owner)
            ->withSession(['previous_url' => route('task-lists.show', ['task_list' => $taskList])])
            ->put(route('tasks.update', ['task' => $task]), [
                'name' => 'Finalize launch checklist',
                'description' => 'Checklist reviewed and updated',
                'due_date' => '2026-04-03',
                'task_list_id' => $taskList->id,
                'assignees' => [$assignee->id],
                'updated_at' => (string) $task->updated_at,
            ]);

        $updateResponse->assertRedirect(route('task-lists.show', ['task_list' => $taskList]));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => 'Finalize launch checklist',
            'description' => 'Checklist reviewed and updated',
            'due_date' => '2026-04-03',
        ]);

        $this->assertDatabaseMissing('task_user', [
            'task_id' => $task->id,
            'user_id' => $owner->id,
        ]);

        $this->assertDatabaseHas('task_user', [
            'task_id' => $task->id,
            'user_id' => $assignee->id,
        ]);

        $completeResponse = $this
            ->actingAs($owner)
            ->from(route('task-lists.show', ['task_list' => $taskList]))
            ->post(route('tasks.complete', ['task' => $task->fresh()]));

        $completeResponse->assertRedirect(route('task-lists.show', ['task_list' => $taskList]));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'complete' => true,
        ]);

        $deleteResponse = $this
            ->actingAs($owner)
            ->withSession(['taskList' => $taskList->id])
            ->delete(route('tasks.destroy', ['task' => $task->fresh()]));

        $deleteResponse->assertRedirect(route('task-lists.show', ['task_list' => $taskList]));

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }
}
