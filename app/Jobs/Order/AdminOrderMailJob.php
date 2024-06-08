<?php

namespace App\Jobs\Order;

use App\Mail\Order\AdminOrderEmail;
use App\Models\order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AdminOrderMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $order;
    public $productQuantities;
    public $defaultManager_email;
    public $subject;
    public function __construct(order $order, $productQuantities,$defaultManager_email = null,$subject = null)
    {
        $this->order = $order;
        $this->productQuantities = $productQuantities;
        $this->defaultManager_email = $defaultManager_email;
        $this->subject = $subject;
    }
    public function handle(Mailer $mailer)
    {
        $recipients = ["info@officetech.com.sa"];
        if ($this->defaultManager_email) {
            $recipients[] = $this->defaultManager_email;
        }
        foreach ($recipients as $recipient) {
            $mailer->to($recipient)->send(new AdminOrderEmail($this->order, $this->productQuantities,$this->subject));
        }
    }
}
