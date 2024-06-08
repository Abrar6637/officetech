<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class serviceProduct extends Model
{
    use HasFactory;
    public $table = 'service_products';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'service_sku',
        'title',
        'description',
        'price',
        'image_url',
        'sale_price',
        'status',
        'meta_title',
        'meta_description',
        'slug',
        'service_id',
    ];
}
