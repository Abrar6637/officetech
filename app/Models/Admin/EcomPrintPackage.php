<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcomPrintPackage extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'content',
        'image',
        'status'
    ];
}
