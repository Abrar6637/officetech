<?php

namespace App\Mail\Request;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminRequestEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $create_service;
    public $customer_order;
    public function __construct($create_service,$customer_order)
    {
        $this->create_service = $create_service;
        $this->customer_order = $customer_order;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'New Request Received',
        );
    }
    public function build()
    {
        $fromAddress = config('mail.from.address');
        $fromName = config('mail.from.name');
        return $this->view('frontend.Email.admin-request')
                    ->from($fromAddress,  $fromName) 
                    ->subject('New Request Received');
    }
}
