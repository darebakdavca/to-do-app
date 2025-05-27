<?php

namespace App\Mail;

use App\Models\TaskList;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TaskListInvite extends Mailable {
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        protected User $user,
        protected TaskList $taskList,
        protected string $link,
    ) {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope {
        return new Envelope(
            subject: 'Task List Invite',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content {
        return new Content(
            html: 'mail.invite',
            with: [
                'user' => $this->user,
                'taskList' => $this->taskList,
                'link' => $this->link,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array {
        return [];
    }
}
