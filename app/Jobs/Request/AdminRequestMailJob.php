<?php

namespace App\Jobs\Request;

use App\Mail\Request\AdminRequestEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AdminRequestMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $create_service;
    public $customer_order;
    public function __construct($create_service,$customer_order)
    {
        $this->create_service = $create_service;
        $this->customer_order = $customer_order;
    }
    public function handle(Mailer $mailer)
    {
        $mailer->to("info@officetech.com.sa")->send(new AdminRequestEmail($this->create_service, $this->customer_order));
    }
}
