<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestQuotation extends Model
{
    protected $fillable = [
        'first_name',
        'user_id',
        'last_name',
        'email',
        'user_id',
        'discount_amount',
        'shipping_amount',
        'address',
        'added_by',
        'discount_amount',
        'grand_total',
        'vat_amount',
        'total_amount',
        'discount_code_coppen',
        'account_manager',
        'region_state',
    ];
    use HasFactory;

    public function products()
    {
        return $this->hasMany(RequestQuotationProduct::class, 'quotation_id');
    }
}
