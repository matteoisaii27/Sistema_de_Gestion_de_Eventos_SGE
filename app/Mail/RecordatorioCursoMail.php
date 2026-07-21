<?php

namespace App\Mail;

use App\Models\Inscripcion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecordatorioCursoMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Inscripcion $inscripcion,
        public int $diasRestantes
    ) {
    }

    public function envelope(): Envelope
    {
        $asunto = $this->diasRestantes === 1
            ? 'Tu curso comienza mañana | Jardín Filosófico'
            : 'Recordatorio: tu curso comienza en 7 días | Jardín Filosófico';

        return new Envelope(
            subject: $asunto,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.recordatorio-curso',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}