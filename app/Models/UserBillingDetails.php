<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBillingDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'company_name',
        'address',
        'country',
        'region',
        'cr_no',
        'vat_reg_no',
        'email',
        'phone_number',
        'account_manager',
        'user_id',
    ];
    public function billingDetails()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
