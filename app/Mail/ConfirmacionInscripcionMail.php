<?php

namespace App\Mail;

use App\Models\Inscripcion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmacionInscripcionMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Inscripcion $inscripcion
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmación de inscripción | Jardín Filosófico',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.confirmacion-inscripcion',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}