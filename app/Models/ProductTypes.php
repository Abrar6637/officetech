<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTypes extends Model
{
    protected $fillable = ['product_type'];
    use HasFactory;
}
