<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer_order extends Model
{
    public $table = 'customer_orders';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'user_id',
        'without_user_id',
        'first_name',
        'last_name',
        'company_name',
        'address',
        'country',
        'region_state',
        'vat_reg_no',
        'company_reg_no',
        'account_manager',
        'additional_notes',
        'email',
        'phone_number',
        // 'arabic_switch',
    ];
    use HasFactory;
}
