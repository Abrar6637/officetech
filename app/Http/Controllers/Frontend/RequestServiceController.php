<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\Request\AdminRequestMailJob;
use App\Jobs\Request\ClientRequestMailJob;
use App\Models\Admin\Services;
use App\Models\customer_order;
use App\Models\RequestService;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class RequestServiceController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $user_email = $request->email;
        $create_service = RequestService::create([
            'service_id' => $request->serviceRequest,
            'contract_year_duration' => $request->contract_year,
            'serial_num_call_req' => $request->serial_number ?? "",
            'serial_num_contract_req' => $request->serial_num_contract_req ?? "",
            'service_contract_details' => $request->service_contract_details,
            'service_call_type' => $request->service_call_type,
            'service_call_description' => $request->call_service_details,
            'order_id' => $request->order_id,
            'user_id' => $request->user_id
        ]);        
        if ($create_service) {
            $customerOrder = customer_order::where('user_id', $request->user_id)->first();
            if ($customerOrder) {
                dispatch(new AdminRequestMailJob($create_service, $customerOrder));
                dispatch(new ClientRequestMailJob($user_email, $create_service));
                return redirect()->back()->with('success', 'Request Submitted Successfully. We Will Respond You ASAP');
            } else {
                return redirect()->back()->with('error', 'CustomerOrder not found for the specified user.');
            }
        } else {
            return redirect()->back()->with('error', 'Error');
        }
    }
}
