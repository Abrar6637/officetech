<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_attribute extends Model
{
    public $table = 'product_attributes';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'product_id',
        'functional',
        'speed',
        'model',
        'type',
        'product_code',
        'yeild',
        'bundles',
        'compatible_toners',
        'paper_size',
    ];
    use HasFactory;
}
