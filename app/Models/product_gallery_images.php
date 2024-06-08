<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_gallery_images extends Model
{
    public $table = 'product_gallery_images';

    protected $fillable = [
        'product_id',
        'images',
    ];
    use HasFactory;
}
