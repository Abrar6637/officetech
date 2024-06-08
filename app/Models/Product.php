<?php

namespace App\Models;

use App\Models\Admin\Reviews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $table = 'product';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'categories_id',
        'sub_categories_id',
        'sub_sub_categories_id',
        'product_type_id',
        'sku',
        'name',
        'model_number',
        'brand_id',
        'availability',
        'quantity',
        'price',
        'sale_price',
        'specifications',
        'license',
        'product_description',
        'warrenty',
        'status',
        'featured_product',
        'recommended',
        'meta_title',
        'slug',
        'min_qty',
        'serial_no',
        'meta_description',
    ];

    public function brand()
    {
        return $this->belongsTo(brands::class, 'brand_id', 'id');
    }

    public function product_item_code()
    {
        return $this->hasMany(product_item_code::class, 'product_id', 'id');
    }

    public function gallery_images()
    {
        return $this->hasMany(product_gallery_images::class, 'product_id', 'id');
    }
    public function product_attribute()
    {
        return $this->hasMany(product_attribute::class, 'product_id', 'id');
    }

    // public function product_attribute()
    // {
    //     return $this->hasMany(product_attribute::class, 'product_id', 'id');
    // }
    public function reviews()
    {
        return $this->hasMany(Reviews::class,'product_id', 'id');
    }
    public function subCategory()
    {
        return $this->belongsTo(sub_main_category::class,'id', 'sub_categories_id');
    }
}
