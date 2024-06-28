<?php

namespace JornBoerema\BzUserManagement\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use JornBoerema\BzUserManagement\Models\Invitation;
use Illuminate\Support\Facades\URL;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    private Invitation $invitation;
    /**
     * Create a new message instance.
     */
    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invitation to join ' . config('app.name'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'bz-user-management::emails.invitation',
            with: [
                'acceptUrl' => URL::signedRoute(
                    "invitation.accept",
                    ['invitation' => $this->invitation]
                ),
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
