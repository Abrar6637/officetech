<?php

namespace App\Http\Controllers\Frontend;

use App\Facades\PaymentFacade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        $token = $request->input('stripeToken');
        $amount  = $request->input('amount');
        $currency  = $request->input('currency');
        $charge = PaymentFacade::processPayment($token, $amount, $currency);
        // $charge =~$this->paymentService->processStripePayment($token, $amount, $currency);
        return response()->json(['success' => true, 'charge' => $charge]);
    }
}
