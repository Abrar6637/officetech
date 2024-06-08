<?php

namespace App\Mail\Order;

use App\Models\order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientOrderEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $productQuantities;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(order $order, $productQuantities,$subject=null)
    {
        $this->order = $order;
        $this->productQuantities = $productQuantities;
        $this->subject = $subject;
    }
    public function build()
    {
        $fromAddress = config('mail.from.address');
        $fromName = config('mail.from.name');
        $subject = $this->subject ?? 'New Order';
        return $this->view('frontend.Email.invoice')
            ->from($fromAddress, $fromName)
            ->subject($subject)
            ->with([
                'order' => $this->order,
                'productQuantities' => $this->productQuantities,
            ]);
    }
}
