<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Http\Request;

class ReturnRequestController extends Controller
{
    //
    public function index()
    {
        $orders = order::all();
        return view('admin.return_request.index', compact('orders'));
    }

    public function approveRequest(Request $request)
    {
        // dd($request->all());
        order::find($request->order_id)->update([
            'return_status' => $request->request_action,
        ]);
        return redirect()->route('admin.return.request')->with('success', 'Return Request Status Updated');
    }
}
