<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class addCategories extends Model
{
    protected $fillable = ['category_name','slug','status','category_order', 'image'];
    use HasFactory;
    public function subCategories()
    {
        return $this->hasMany(sub_main_category::class, 'parent_category_id', 'id');
    }

    public function subSubCategories()
    {
        return $this->hasMany(categories::class, 'main_category_id', 'id');
    }
    public function product()
    {
        return $this->hasMany(Product::class,'categories_id','id');
    }
    

}
