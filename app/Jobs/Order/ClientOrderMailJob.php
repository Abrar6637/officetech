<?php

namespace App\Jobs\Order;

use App\Mail\Order\ClientOrderEmail;
use App\Models\order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ClientOrderMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $order;
    public $productQuantities;
    public $subject;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(order $order, $productQuantities,$subject=null)
    {
        $this->order = $order;
        $this->productQuantities = $productQuantities;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $recipientEmail = $this->order->customer->email;
        $mailer->to($recipientEmail)->send(new ClientOrderEmail($this->order,$this->productQuantities,$this->subject));
    }
}
