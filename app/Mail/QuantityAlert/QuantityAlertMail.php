<?php

namespace App\Mail\QuantityAlert;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class QuantityAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $lowQuantityProducts;

    public function __construct(Collection $lowQuantityProducts)
    {
        $this->lowQuantityProducts = $lowQuantityProducts;
    }

    public function build()
    {
        return $this->subject('Low Quantity Alert')
                    ->view('frontend.Email.low_quantity_notification');
    }

}
