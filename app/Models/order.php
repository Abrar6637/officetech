<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    public $table = 'orders';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'customer_id',
        'order_status',
        'payment_status',
        'return_status',
        'discount_amount',
        'total_amount',
        'grand_total',
        'vat_amount',
        'discount_code_coppen',
        'shipping_amount',
        'order_number',
        'order_payment_status',
        'tran_ref',
    ];
    public function customer()
    {
        return $this->belongsTo(customer_order::class, 'customer_id','id');
    }
    public function productQuantities()
    {
        return $this->belongsTo(order_product_quantity::class,'id','order_id');
    }
    public function productQuantity()
    {
        return $this->hasMany(order_product_quantity::class,'order_id','id');
    }
    public function serviceRequest()
    {
        return $this->hasMany(RequestService::class, 'order_id', 'id');
    }

}
