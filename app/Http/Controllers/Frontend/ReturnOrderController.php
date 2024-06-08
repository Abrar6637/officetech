<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\ReturnOrder\AdminReturnOrderMailJob;
use App\Jobs\ReturnOrder\ClientReturnOrderMailJob;
use App\Models\customer_order;
use App\Models\order;
use Illuminate\Http\Request;

class ReturnOrderController extends Controller
{
    //
    public function returnOrder($orderId)
    {
        // dd(decrypt($orderId));
        $id = decrypt($orderId);
        $order = order::find($id);
        $customer_order = customer_order::find($order->customer_id);
        // dd($customer_order);
        order::find($id)->update([
            'return_status' => '1',
        ]);
        dispatch(new AdminReturnOrderMailJob($order,$customer_order));
        dispatch(new ClientReturnOrderMailJob($order,$customer_order));
        return redirect()->route('user.orders')->with('success', 'Return Of Order Requested Successfully');
    }
}
