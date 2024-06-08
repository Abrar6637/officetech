<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountManager extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'status',
        'is_default_manager'
    ];
}
