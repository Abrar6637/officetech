<?php

namespace App\Jobs\Quotation;

use App\Mail\Quotation\AdminQuotaionMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AdminQuotaionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $carts;
    public $billingInfo;
    public $defaultManager_email;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($carts, $billingInfo,$defaultManager_email = null)
    {
        $this->carts = $carts;
        $this->billingInfo = $billingInfo;
        $this->defaultManager_email = $defaultManager_email;
    }

    public function handle(Mailer $mailer)
    {
        $recipients = ["info@officetech.com.sa"];
        if ($this->defaultManager_email) {
            $recipients[] = $this->defaultManager_email;
        }
        foreach ($recipients as $recipient) {
            $mailer->to($recipient)->send(new AdminQuotaionMail($this->carts,$this->billingInfo));
        }
    }
}
