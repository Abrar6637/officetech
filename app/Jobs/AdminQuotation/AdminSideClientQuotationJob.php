<?php

namespace App\Jobs\AdminQuotation;

use App\Mail\AdminQuotation\AdminSideClientQuotationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AdminSideClientQuotationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $request_quotation;
    public $mergedProducts;
    public $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request_quotation, $mergedProducts, $user)
    {
        //
        $this->request_quotation = $request_quotation;
        $this->mergedProducts = $mergedProducts;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        //
        $recipientEmail =$this->request_quotation['email'];
        $mailer->to($recipientEmail)->send(new AdminSideClientQuotationMail($this->request_quotation,$this->mergedProducts, $this->user));
    }
}
