<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AccountMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public function __construct($email)
    {
        $this->email=$email;
    }

    public function build()
    {
        return $this->subject('Votre compte crée avec success')
                    ->view('emails.acountCreated')
                    ->with(['email' => $this->email]);
    }
}
