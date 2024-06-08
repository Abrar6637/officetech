<?php
namespace App\Interface;

interface PaymentMethod
{
    public function processPayment($token, $amount, $currency);
}