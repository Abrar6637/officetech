<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\Order\AdminOrderMailJob;
use App\Jobs\Order\ClientOrderMailJob;
use App\Models\Admin\AccountManager;
use App\Models\Admin\Country;
use App\Models\Admin\Region;
use App\Models\customer_order;
use App\Models\order;
use App\Models\order_product_quantity;
use App\Models\Product;
use App\Models\RequestService;
use App\Models\User;
use App\Models\trackorder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    public function orders()
    {
        $orders = Order::orderBy('order_number','desc')->where('is_deleted','0')->get();

        return view('admin.order')->with('orders', $orders);
    }
    public function destory($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->is_deleted = 1;
            $order->save();
            session()->flash('success', 'Order deleted successfully');
        } catch (ModelNotFoundException $e) {
            session()->flash('error', 'Order not found');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting order');
        }
        return back();
    }
    public function updateOrderStatus(Request $request, $orderId)
    {
        $request->validate([
            'orderStatus' => 'required|in:processing,shipped,En Route,delivered,On Hold',
            'ordermessage' => 'required',
        ]);
        $order = Order::find($orderId);
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }
        $order->order_status = $request->input('orderStatus');
        $order->save();

        $order_id = $order->id;
        $order_email = $order->customer->email;
        $order_number = $order->order_number;
        if (!$order_id) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }
        $trackOrder = new trackorder();
        $trackOrder->order_status = $request->input('orderStatus');
        $trackOrder->order_id = $order_id;
        $trackOrder->billing_email = $order_email;
        $trackOrder->track_order_msg = $request->input('ordermessage');
        $trackOrder->order_number = $order_number;
        $trackOrder->save();
        return response()->json(['success' => true, 'message' => 'Order status updated successfully']);
    }

    public function create_order()
    {
        $regions = Region::where('status','1')->get();
        $countries = Country::where('status','1')->get();
        $AccountManagers = AccountManager::all();
        $products = Product::where('status','1')->get();
        return view('admin.Admin-Order.create',compact('products','regions','AccountManagers','countries'));
    }
    public function store_order(Request $request)
    {
        $validator = $request->validate([
            'first_name' => ['required', 'string', 'max:190'],
            'last_name' => ['required', 'string', 'max:190'],
            'address' => ['required', 'string', 'max:190'],
            'phone' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        if($validator)
        {
            $user = User::where('email',$request->email)->first();
            $user_id = "";
            $invoice_no = '';

            if ($user) {
                $user_id = $user->id;
            } else {
                $randomPassword = Str::random(12);
                $user = User::create([
                    'name' => $request->first_name,
                    'email' => $request->email,
                    'user_type' => 'guest_user',
                    'password' => bcrypt($randomPassword),
                ]);
            
                $user_id = $user->id;
            }
            customer_order::create([
                'user_id' => $user_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company_name' => $request->company_name,
                'address' => $request->address,
                'country' => $request->country,
                'region_state' => $request->region_state,
                'vat_reg_no' => $request->vat_reg_no,
                'company_reg_no' => $request->company_reg_no,
                'account_manager' => $request->account_manager,
                'email' => $request->email,
                'phone_number' => $request->phone,
            ]);
            
            $customer_id = customer_order::where('user_id', $user_id)->orderBy('created_at', 'desc')->first()->id;
            $order_number = "OS-" . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $order = order::create([
                'customer_id' => $customer_id,
                'order_status' => 'New Order Placed',
                'payment_status' => 'COD',
                'discount_amount' => $request->discount_amount,
                'discount_code_coppen' => $request->coupon_name,
                'total_amount' => $request->subtotal,
                'shipping_amount' => $request->shipping_amount,
                'vat_amount' => $request->vat_amount,
                'grand_total' => $request->new_total_amount,
                'order_number' => $order_number,
            ]);
            if ($order->id > 1000) {
                $invoice_no = (string) $order->id;
            } elseif ($order->id > 100) {
                $invoice_no = '0' . $order->id;
            } else {
                $invoice_no = '00' . $order->id;
            }
            $order->invoice_no = $invoice_no;
            $order->save();
            
            $order_id = order::where('customer_id', $customer_id)->orderBy('created_at', 'desc')->first()->id;
            $product_ids = explode(',', $request->product_ids);
            $product_ids = array_reverse($product_ids);
            if ($request->quantity > 0) {
                $quantities = $request->quantity;
            } else {
                $quantities = 1;
            }
            $serial_nos = $request->serial_no;
            
            foreach ($product_ids as $index => $product_id) {
                $quantity = $quantities[$index];
                $serial_no = isset($serial_nos[$index]) ? $serial_nos[$index] : null;
                order_product_quantity::create([
                    'order_id' => $order_id,
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                    'serial_no' => $serial_no, 
                ]);
            }
            $productQuantities = $order->productQuantity;
            $defaultManager = AccountManager::where('name', $request->account_manager)->first();
            $subject = "Order Placed by Admin";
            if($defaultManager){
                $defaultManager_email = $defaultManager->email;
                dispatch(new AdminOrderMailJob($order,$productQuantities,$defaultManager_email,$subject));
            }
            else{
                dispatch(new AdminOrderMailJob($order,$productQuantities,$subject));
            }
            dispatch(new ClientOrderMailJob($order,$productQuantities,$subject));
            return redirect()->route('admin.orders')->with('success', 'Order Created Successfully')
            ->with('order_number',$order_number);
            
            return redirect()->back()->with('success', 'Order Created Successfully')->with('order_number', $order_number);
            
        }
        else
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
    public function edit_order($id)
    {
        $order_details = order::where('id',$id)->first();
        $countries = Country::where('status','1')->get();
        $services = $order_details->serviceRequest;
        $cluster_no = null;

        if ($services->isNotEmpty()) {
            $firstServiceRequest = $services->first();
            $cluster_no = $firstServiceRequest->serial_number;
        }
        $regions = Region::where('status','1')->get();
        $AccountManager = AccountManager::all();
        $orderProducts = $order_details->productQuantity;
        foreach($orderProducts as $orderProduct){
            $orderProduct['product_details'] = $orderProduct->product;
        }

        $productIds = $orderProducts->pluck('product_id')->toArray();
        $productIdsString = implode(',', $productIds);
        
        $products = Product::all();
        return view('admin.Admin-Order.edit')
        ->with('order_details',$order_details)
        ->with('orderProducts',$orderProducts)
        ->with('products',$products)
        ->with('productIdsString',$productIdsString)
        ->with('regions',$regions)
        ->with('AccountManagers',$AccountManager)
        ->with('countries',$countries)
        ->with('cluster_no', $cluster_no);  
    }
    public function update_order(Request $request,$orderId)
    {
        // dd($request->all());
        $validator = $request->validate([
            'first_name' => ['required', 'string', 'max:190'],
            'last_name' => ['required', 'string', 'max:190'],
            'address' => ['required', 'string', 'max:190'],
            'phone' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        if($validator)
        {
                $order = order::findOrFail($orderId);
                $order_number = $order->order_number;
                $customer = $order->customer->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'company_name' => $request->company_name,
                    'address' => $request->address,
                    'country' => $request->country,
                    'region_state' => $request->region_state,
                    'vat_reg_no' => $request->vat_reg_no,
                    'company_reg_no' => $request->company_reg_no,
                    'account_manager' => $request->account_manager,
                    'email' => $request->email,
                    'phone_number' => $request->phone,
                ]);
                $vat = $request->total_price*0.15;
                $order->update([
                    'payment_status' => 'COD',
                    'discount_amount' => $request->discount_amount,
                    'discount_code_coppen' => $request->coupon_name,
                    'total_amount' => $request->new_subtotal,
                    'shipping_amount'=>$request->shipping_amount,
                    'vat_amount'=> $request->vat_amount,
                    'grand_total' => $request->new_total_amount,
                ]);
                $productIds = explode(',', $request->product_ids);
                if ($request->quantity > 0) {
                    $quantities = $request->quantity;
                } else {
                    $quantities = 1;
                }
                $serial_nos = $request->serial_no;
                $order_delete = order_product_quantity::where('order_id', $orderId)->delete(); 
                if($order_delete)
                {
                    foreach ($productIds as $index => $productId) {
                        $quantity = $quantities[$index];
                        $serial_no = isset($serial_nos[$index]) ? $serial_nos[$index] : null;
                        order_product_quantity::create([
                            'order_id' => $orderId,
                            'product_id' => $productId,
                            'quantity' => $quantity,
                            'serial_no' => $serial_no, 
                        ]);
                    }
                    $productQuantities = $order->productQuantity;
                    $defaultManager = AccountManager::where('name', $request->account_manager)->first();
                    $subject = "Order Updated by Admin";
                    if($defaultManager){
                        $defaultManager_email = $defaultManager->email;
                        dispatch(new AdminOrderMailJob($order,$productQuantities,$defaultManager_email,$subject));
                    }
                    else{
                        dispatch(new AdminOrderMailJob($order,$productQuantities,$subject));
                    }
                    dispatch(new ClientOrderMailJob($order,$productQuantities,$subject));
                    return redirect()->route('admin.orders')->with('success', 'Order Updated Successfully')
                    ->with('order_number',$order_number);
                }
                
        }
        else
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
    public function orderInvoice($orderId)
    {
        $id = decrypt($orderId);
        $order = Order::find($id);
        if ($order) {
            $productQuantities = $order->productQuantity;
            if ($productQuantities) {
                return view('admin.Admin-Order.Invoice.admin-invoice', compact('order', 'productQuantities'));
            }
        }
        else
        {
            abort(404);
        }
    }
    public function updateShipping(Request $request)
    {
        $selectedRegionState = $request->input('selectedRegionState');
        $subtotal = floatval($request->input('subtotal'));
        $discountAmount = $request->has('discountAmount') ? $request->input('discountAmount') : "0";
        $discountAmount = floatval($discountAmount);
        $shipping = Region::where('name', $selectedRegionState)->first();
        if (!$shipping) {
            return response()->json(['error' => 'Shipping information not found for the selected region.']);
        }
        $shippingAmount = ($shipping->shipping_type === '0') ? floatval($shipping->amount) : ($subtotal * floatval($shipping->amount) / 100);
        if ($discountAmount) {
            $subtotal -= $discountAmount;
        }
        $subtotal = number_format($subtotal, 2, '.', ''); 
        $shippingAmount = number_format($shippingAmount, 2, '.', ''); 
        $grandTotal = $subtotal + $shippingAmount;
        return response()->json(['shippingAmount' => $shippingAmount, 'grandTotal' => $grandTotal, 'DiscountAmount' => number_format($discountAmount, 2, '.', ''), 'Subtotal' => $subtotal]);
    }
}
