<?php

namespace App\Mail;

use App\Models\DateResponse;
use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvitationResponseReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Invitation $invitation,
        public DateResponse $dateResponse,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '💌 Nouvelle réponse à ton invitation',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.invitation-response-received',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
