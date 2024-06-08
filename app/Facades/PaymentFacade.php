<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Interface\PaymentMethod;
class PaymentFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PaymentMethod::class;
    }
}