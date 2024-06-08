<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'sku',
        'image',
        'product_slug',
        'status',
        'prints',
        'contract_years'
    ];
}
