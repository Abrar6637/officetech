<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_item_code extends Model
{
    public $table = 'product_item_codes';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'product_id',
        'product_code',
    ];
    use HasFactory;
}
