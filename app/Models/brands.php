<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brands extends Model
{
    use HasFactory;
    public $table = 'brands';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'product_type_id',
        'brand_name',
        'image',
        'slug',
    ];
}
