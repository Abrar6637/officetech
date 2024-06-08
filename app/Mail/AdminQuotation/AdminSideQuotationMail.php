<?php

namespace App\Mail\AdminQuotation;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminSideQuotationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $request_quotation;
    public $mergedProducts;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request_quotation, $mergedProducts)
    {
        //
        $this->request_quotation = $request_quotation;
        $this->mergedProducts = $mergedProducts;
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
        return $this->view('frontend.Email.admin-side-request-quotation')
                    ->from($fromAddress,  $fromName)
                    ->subject('Admin Quotation Mail');
    }
}
