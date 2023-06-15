<?php

namespace App\Mail;

use App\Models\Servicio;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Notificacion extends Mailable
{
    use Queueable, SerializesModels;

    public $servicio;
    public $dueño;
    public $cliente;

    /**
     * Create a new message instance.
     */
    public function __construct(Servicio $servicio, User $dueño, User $cliente)
    {
        $this->servicio=$servicio;
        $this->dueño=$dueño;
        $this->cliente=$cliente;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Informacion para el interesado',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.emailServicio',
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
