<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_main_category extends Model
{
    protected $fillable = [
        'sub_category_name',
        'parent_category_id',
        'slug',
        'status',
        'category_order',
    ];
    use HasFactory;
    public function mainCategory()
    {
        return $this->belongsTo(addCategories::class, 'parent_category_id', 'id');
    }

    public function subSubCategories()
    {
        return $this->hasMany(categories::class, 'sub_category_id', 'id')->onDelete('cascade');
    }
    public function product()
    {
        return $this->hasMany(Product::class,'categories_id','id');
    }
    public function Products()
    {
        return $this->hasMany(Product::class,'sub_categories_id','id');
    }
}
