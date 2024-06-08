<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_product_quantity extends Model
{
    use HasFactory;
    public $table = 'order_product_quantities';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'product_id',
        'quantity',
        'order_id',
        'serial_no',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function order()
    {
        return $this->belongsTo(order::class, 'order_id', 'id');
    }
}
