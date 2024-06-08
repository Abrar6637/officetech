<?php

namespace App\Mail\Contact;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $formData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $formData)
    {
        $this->formData = $formData;
    }

    public function build()
    {
        $fromAddress = config('mail.from.address');
        $fromName = config('mail.from.name');
        return $this->view('frontend.Email.contact-us')
                    ->from($fromAddress,  $fromName) 
                    ->subject('Your Contact ');
    }
}
