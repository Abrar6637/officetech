<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'region_id',
        'status'
    ];
    public function region()
    {
        return $this->belongsTo(Region::class,'region_id','id');
    }
}
