<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailTest extends Mailable
{
    use Queueable, SerializesModels;

    public $name_client;

    public function __construct($client)
    {
        $this->name_client = $client;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Assunto!!',
        );
    }

    public function content(): Content
    {
        return new Content(

            /*another way to send information by email */
            with: [
                'status' => 'Concluído',
                'product' => 'carburador',
            ],


            view: 'emails/emailtest',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
