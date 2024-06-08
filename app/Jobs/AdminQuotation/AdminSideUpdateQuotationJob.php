<?php

namespace App\Jobs\AdminQuotation;

use App\Mail\AdminQuotation\AdminSideUpdateQuotationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AdminSideUpdateQuotationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $request_quotation;
    public $mergedProducts;
    public $account_manager_email;
    public $subject;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request_quotation, $mergedProducts,$account_manager_email=null,$subject = null)
    {
        $this->request_quotation = $request_quotation;
        $this->mergedProducts = $mergedProducts;
        $this->account_manager_email = $account_manager_email;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $recipients = ["info@officetech.com.sa"];
        if ($this->account_manager_email) {
            $recipients[] = $this->account_manager_email;
        }
        foreach ($recipients as $recipient) {
            $mailer->to($recipient)->send(new AdminSideUpdateQuotationMail($this->request_quotation,$this->mergedProducts));
        }
    }
}
