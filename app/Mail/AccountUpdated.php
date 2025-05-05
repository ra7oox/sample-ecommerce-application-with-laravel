<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AccountUpdated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $statut;
    public function __construct($statut)
    {
        $this->statut=$statut;
    }

    public function build()
    {
        return $this->subject('Votre compte'.$this->statut.' crée avec success')
                    ->view('emails.accountUpdated')
                    ->with(['statut' => $this->statut]);
    }
}
