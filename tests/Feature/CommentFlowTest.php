<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Task;
use App\Models\TaskList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_update_and_delete_a_comment(): void
    {
        $user = User::factory()->create();

        $taskList = TaskList::create([
            'name' => 'Shared List',
            'description' => 'Collaboration space',
            'type' => 'shared',
            'user_id' => $user->id,
        ]);

        $taskList->users()->attach($user->id);

        $task = Task::create([
            'task_list_id' => $taskList->id,
            'name' => 'Review comments',
            'description' => 'Check comment flow',
            'due_date' => '2026-04-05',
        ]);

        $task->users()->attach($user->id);

        $commentUrl = route('task-lists.show', ['task_list' => $taskList]);

        $createResponse = $this
            ->actingAs($user)
            ->withSession([
                'taskList' => $taskList->id,
                'previous_url' => $commentUrl,
            ])
            ->post(route('comments.store'), [
                'content' => 'Initial comment',
                'task_id' => $task->id,
            ]);

        $comment = Comment::firstOrFail();

        $createResponse->assertRedirect($commentUrl);

        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'content' => 'Initial comment',
            'task_id' => $task->id,
            'user_id' => $user->id,
        ]);

        $updateResponse = $this
            ->actingAs($user)
            ->withSession([
                'taskList' => $taskList->id,
                'previous_url' => $commentUrl,
            ])
            ->put(route('comments.update', ['comment' => $comment]), [
                'content' => 'Updated comment',
                'updated_at' => (string) $comment->updated_at,
            ]);

        $updateResponse->assertRedirect($commentUrl);

        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'content' => 'Updated comment',
        ]);

        $deleteResponse = $this
            ->actingAs($user)
            ->withSession([
                'previous_url' => $commentUrl,
            ])
            ->delete(route('comments.destroy', ['comment' => $comment->fresh()]));

        $deleteResponse->assertRedirect($commentUrl);

        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
        ]);
    }
}
