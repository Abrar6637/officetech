<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $fillable = [
        'main_category_id',
        'sub_category_id',
        'sub_category_name',
    ];
    use HasFactory;
    public function mainCategory()
    {
        return $this->belongsTo(addCategories::class, 'main_category_id', 'id')->onDelete('cascade');
    }

    public function subCategory()
    {
        return $this->belongsTo(sub_main_category::class, 'sub_category_id', 'id')->onDelete('cascade');
    }
}
