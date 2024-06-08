<?php
namespace App\Providers;

use App\Interface\PaymentMethod;
use Illuminate\Support\ServiceProvider;
use App\Services\StripePaymentService;
use App\Services\PayPalPaymentService;

class PaymentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PaymentMethod::class, StripePaymentService::class);
    }
}