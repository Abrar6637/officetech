<?php
namespace App\Services;
use App\Interface\PaymentMethod;
use Stripe\Stripe;
use Stripe\Charge;

class StripePaymentService implements PaymentMethod
{
    public function processPayment($token, $amount, $currency)
    {
        $stripeSecretKey = config('services.stripe.secret_key');
        Stripe::setApiKey($stripeSecretKey);
        $charge = Charge::create([
            'amount' => $amount,
            'currency' => $currency,
            'source' => $token,
        ]);
        return $charge;
    }
}