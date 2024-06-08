<?php

namespace App\Mail\Request;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientRequestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $create_service;
    public $user_email;
    public function __construct($user_email,$create_service)
    {
        $this->create_service = $create_service;
        $this->user_email = $user_email;
    }
    public function envelope()
    {
        return new Envelope(
            subject: 'New Service',
        );
    }

    public function build()
    {
        $fromAddress = config('mail.from.address');
        $fromName = config('mail.from.name');
        return $this->view('frontend.Email.client-request')
                    ->from($fromAddress,  $fromName) 
                    ->subject('New Service');
    }
}
