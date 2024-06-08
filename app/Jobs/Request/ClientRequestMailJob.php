<?php

namespace App\Jobs\Request;

use App\Mail\Request\ClientRequestEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ClientRequestMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $create_service;
    public $user_email;
    public function __construct($user_email,$create_service)
    {
        $this->create_service = $create_service;
        $this->user_email = $user_email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $recipientEmail = $this->user_email;
        $recipientEmail = is_array($recipientEmail) ? $recipientEmail : [$recipientEmail];
    
        // $mailer->to($recipientEmail)->send(new ClientRequestEmail($this->user_email, $this->create_service));
        $mailer->to($recipientEmail)->send(new ClientRequestEmail($this->user_email, $this->create_service));
    }
    
}
