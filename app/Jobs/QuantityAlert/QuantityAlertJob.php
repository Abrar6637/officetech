<?php

namespace App\Jobs\QuantityAlert;

use App\Mail\QuantityAlert\QuantityAlertMail;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class QuantityAlertJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $lowQuantityProducts = Product::whereColumn('quantity', '<=', 'min_qty')->get();
    
        if ($lowQuantityProducts->isNotEmpty()) {
            Mail::to('info@officetech.com.sa')->send(new QuantityAlertMail($lowQuantityProducts));
        }
    }
}
