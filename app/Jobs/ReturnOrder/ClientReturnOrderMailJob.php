<?php

namespace App\Jobs\ReturnOrder;

use App\Mail\ReturnOrder\ClientReturnOrderEmail;
use App\Models\order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ClientReturnOrderMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $order;
    public $customer_order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order, $customer_order)
    {
        $this->order = $order;
        $this->customer_order = $customer_order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $mailer->to("hassanshabbirbutt17@gmail.com")->send(new ClientReturnOrderEmail($this->order,$this->customer_order));
    }
}
