<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StatutMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $type;
    public $entity;
    public $reason;

    /**
     * Create a new message instance.
     */
    public function __construct($type, $entity, $reason)
    {
        $this->type = $type;
        $this->entity = $entity;
        $this->reason = $reason;
    }

    /**
     * Get the message envelope.
     */
    public function envelope($entity): Envelope
    {
        return new Envelope(
            subject: 'Notification de Déclaration N°' . $entity->id,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mails.statut',
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
