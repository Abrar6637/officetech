<?php

namespace App\Models\Admin;

use App\Models\RequestService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'slug',
        'status',
    ];

    public function requests() 
    {
        return $this->hasMany(RequestService::class,'service_id','id');
    }

}
