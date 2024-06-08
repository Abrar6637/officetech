<?php

namespace App\Mail\AdminQuotation;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminSideClientQuotationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $request_quotation;
    public $mergedProducts;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request_quotation, $mergedProducts, $user)
    {
        //
        $this->request_quotation = $request_quotation;
        $this->mergedProducts = $mergedProducts;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Admin Quotation Mail',
        );
    }

    public function build()
    {
        $fromAddress = config('mail.from.address');
        $fromName = config('mail.from.name');
        return $this->view('frontend.Email.admin-side-client-request-quotation')
                    ->from($fromAddress,  $fromName)
                    ->subject('Client Quotation Mail');
    }
}
