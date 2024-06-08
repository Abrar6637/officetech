<?php

namespace App\Mail\Quotation;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminQuotaionMail extends Mailable
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
    public function envelope()
    {
        return new Envelope(
            subject: 'New Quotaion Placed',
        );
    }

    public function build()
    {
        $fromAddress = config('mail.from.address');
        $fromName = config('mail.from.name');
        return $this->view('frontend.Email.request_quotation')
                    ->from($fromAddress,  $fromName)
                    ->subject('Admin Quotation Mail');
    }
}
