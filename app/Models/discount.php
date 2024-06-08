<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class discount extends Model
{
    public $table = 'discount_coupons';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'discount_coupon',
        'discount',
        'discount_type',
        'start_date',
        'end_date',
        'is_one_time',
        'status',
        // 'arabic_switch',
    ];
    use HasFactory;
}
