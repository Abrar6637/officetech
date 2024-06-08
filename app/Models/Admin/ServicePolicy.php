<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePolicy extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'content',
        'image',
        'status'
    ];
}
