<?php
namespace App\Services;
use App\Interface\PaymentMethod;
use Stripe\Stripe;
use Stripe\Charge;

class PayPalPaymentService implements PaymentMethod
{
    public function processPayment($token, $amount, $currency)
    {
        Stripe::setApiKey("sk_test_51Nk6wxAQzgSCHThDH04gePTi4GlybTB2AUbfQYwdESp4PwkYcFD8NU1snyndP5MFVrh7rm9RsvKVigUG1K1dKRLU008nY16cnU");
        $charge = Charge::create([
            'amount' => $amount,
            'currency' => $currency,
            'source' => $token,
        ]);

        return $charge;
    }
}