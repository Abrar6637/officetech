<?php

namespace App\Jobs\Contact;

use App\Mail\Contact\AdminContactEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AdminContactMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $formData;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $formData)
    {
        $this->formData = $formData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $mailer->to("info@officetech.com.sa")->send(new AdminContactEmail($this->formData));
    }
}
