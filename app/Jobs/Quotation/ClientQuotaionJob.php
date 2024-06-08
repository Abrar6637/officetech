<?php

namespace App\Jobs\Quotation;

use App\Mail\Quotation\ClientQuotaionMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ClientQuotaionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $carts;
    public $billingInfo;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($carts, $billingInfo)
    {
        $this->carts = $carts;
        $this->billingInfo = $billingInfo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $recipientEmail = $this->billingInfo['email'];
        $mailer->to($recipientEmail)->send(new ClientQuotaionMail($this->carts,$this->billingInfo));
    }
}
