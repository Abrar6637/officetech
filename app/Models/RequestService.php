<?php

namespace App\Models;

use App\Models\Admin\Services;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestService extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'contract_year_duration',
        'serial_num_call_req',
        'serial_num_contract_req',
        'service_contract_details',
        'service_call_type',
        'service_call_description',
        'order_id',
        'user_id',
    ];

    public function service()
    {
        return $this->belongsTo(Services::class, 'service_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(order::class, 'order_id', 'id');
    }
    
}
