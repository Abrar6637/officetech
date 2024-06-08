<?php

namespace App\Models;

use App\Models\Admin\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trackorder extends Model
{
    use HasFactory;
    public $table = 'trackorders';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'order_status',
        'order_id',
        'billing_email',
        'track_order_msg',
        'order_number',
    ];
    public function order()
    {
        return $this->belongsTo(order::class, 'order_id', 'id');
    }
    public function order_product()
    {
        return $this->hasMany(order_product_quantity::class, 'order_id', 'order_id');
    }
    public function customer()
    {
        return $this->order->customer();
    }
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_state', 'region_state');
    }
}
