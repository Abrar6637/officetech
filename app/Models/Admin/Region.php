<?php

namespace App\Models\Admin;

use App\Models\trackorder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'amount',
        'delivery_days',
        'status',
        'shipping_type'
    ];
    public function city()
    {
        return $this->hasMany(Cities::class,'region_id','id');
    }
}
