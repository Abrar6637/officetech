<?php

namespace App\Mail\ReturnOrder;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientReturnOrderEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $customer_order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $customer_order)
    {
        $this->order = $order;
        $this->customer_order = $customer_order;
    }
    public function build()
    {
        $fromAddress = config('mail.from.address');
        $fromName = config('mail.from.name');
        return $this->view('frontend.Email.client-return-request')
                    ->from($fromAddress,  $fromName)
                    ->subject('Return Request Received');
    }
}
