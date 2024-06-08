<?php

namespace App\Models;

use App\Models\Admin\Reviews;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }
    public function accountDetails()
    {
        return $this->belongsTo(UserAccountDetails::class,'id','user_id');
    }
    public function billingDetails()
    {
        return $this->hasOne(UserBillingDetails::class);
    }
}
