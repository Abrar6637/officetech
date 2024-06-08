<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'quantity',
        'ip_address',
        'user_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function gallery_images()
    {
        return $this->hasMany(product_gallery_images::class, 'product_id', 'product_id');
    }
}
