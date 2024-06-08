<?php

namespace App\Models\Admin;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $fillable = [
        'rating',
        'review',
        'name',
        'advantages',
        'flaws',
        'email',
        'user_id',
        'product_id'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    use HasFactory;
}
