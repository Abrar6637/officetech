<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccountDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'display_name',
        'user_name',
        'full_name',
        'email',
        'phone_number',
        'user_id',
    ];
    public function accountDetails()
    {
        return $this->belongsTo(User::class,'id','user_id');
    }
}
