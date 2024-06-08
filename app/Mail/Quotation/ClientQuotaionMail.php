<?php

namespace App\Mail\Quotation;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientQuotaionMail extends Mailable
{
    use Queueable, SerializesModels;
    public $carts;
    public $billingInfo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($carts, $billingInfo)
    {
        $this->carts = $carts;
        $this->billingInfo = $billingInfo;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Quotaion Recevied',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function build()
    {
        $fromAddress = config('mail.from.address');
        $fromName = config('mail.from.name');
        return $this->view('frontend.Email.request_quotation')
                    ->from($fromAddress,  $fromName)
                    ->subject('Client Quotation Mail');
    }
}
