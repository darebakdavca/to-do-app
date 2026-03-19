<?php

namespace Tests\Feature;

use App\Models\Invitation;
use App\Models\TaskList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvitationFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_invitation_link_can_be_generated_and_accepted(): void
    {
        $owner = User::factory()->create();
        $invitee = User::factory()->create();

        $taskList = TaskList::create([
            'name' => 'Project Alpha',
            'description' => 'Launch planning',
            'type' => 'shared',
            'user_id' => $owner->id,
        ]);

        $taskList->users()->attach($owner->id);

        $showResponse = $this
            ->actingAs($owner)
            ->get(route('share.index', ['task_list' => $taskList]));

        $showResponse->assertOk();
        $showResponse->assertSee('Copy link:', false);

        $invitation = Invitation::firstOrFail();

        $acceptResponse = $this
            ->actingAs($invitee)
            ->get(route('share.accept', ['token' => $invitation->token]));

        $acceptResponse->assertRedirect(route('task-lists.show', ['task_list' => $taskList]));

        $this->assertDatabaseHas('task_list_user', [
            'task_list_id' => $taskList->id,
            'user_id' => $invitee->id,
        ]);

        $this->assertDatabaseHas('invitations', [
            'id' => $invitation->id,
            'task_list_id' => $taskList->id,
        ]);

        $this->assertNotNull($invitation->fresh()->accepted_at);
    }
}
