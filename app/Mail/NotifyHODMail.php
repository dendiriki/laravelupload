<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifyHODMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var array
     */
    public $details;

    /**
     * Create a new message instance.
     *
     * @param array $details
     * @return void
     */
    public function __construct(array $details)
    {
        $this->details = $details;
    }

    /**
     * Get the message envelope.
     *
     * @return $this
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notify Digitalisasi Document',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.notify_hod',
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
