<?php

namespace App\Http\Controllers\Admin\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\Order\AdminOrderMailJob;
use App\Jobs\Order\ClientOrderMailJob;
use App\Models\Admin\AccountManager;
use App\Models\Cart;
use App\Models\order;
use App\Models\discount;
use App\Models\order_product_quantity;
use App\Models\customer_order;
use App\Models\Product;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
class orderController extends Controller
{
    // public function add_order_customer(Request $request)
    // {

    //     // dd($request->all());
    //     $client = new Client();
    //     $payment_method = $request->payment_status;
    //     $without_user_add_to_Cart = null;
    //     $user_id = Session::get('user_id');
    //     $arabic_switch = Session::get('arabic_switch');
    //     $validator = Validator::make($request->all(), [
    //         'first_name' => ['required', 'string', 'max:190'],
    //         'last_name' => ['required', 'string', 'max:190'],
    //         'address' => ['required', 'string', 'max:190'],
    //         'phone_number' => ['required', 'integer'],
    //         'email' => ['required', 'string', 'email', 'max:255'],

    //     ]);
    //     if ($validator->fails()) {
    //         Session::flash('error_message', '1');
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    //     if (empty($user_id)) {
    //         $without_user_add_to_Cart = Session::get('without_user_add_to_Cart');
    //         $user_id = $without_user_add_to_Cart;
    //     }
    //     if($payment_method == "Bank-Transfer"){
    //         customer_order::create([
    //             'user_id' => $user_id,
    //             'first_name' => $request->first_name,
    //             'last_name' => $request->last_name,
    //             'company_name' => $request->company_name,
    //             'address' => $request->address,
    //             'without_user_id' => $without_user_add_to_Cart,
    //             'country' => $request->country,
    //             'region_state' => $request->region_state,
    //             'vat_reg_no' => $request->vat_reg_no,
    //             'company_reg_no' => $request->company_reg_no,
    //             'account_manager' => $request->account_manager,
    //             'additional_notes' => $request->additional_notes,
    //             'email' => $request->email,
    //             'phone_number' => $request->phone_number,
    //             'arabic_switch' => $arabic_switch,
    //         ]);

    //         $customer_id = customer_order::where('user_id', $user_id)->orderBy('created_at', 'desc')->first()->id;
    //         $order_number = "OS-" . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
    //         $vatPrice=$request->total_amount-$request->discount_amount;
    //         $vatPrice=$vatPrice* 0.15;
    //         $success = order::create([
    //             'customer_id' =>  $customer_id,
    //             'order_status' => 'New Order Placed',
    //             'payment_status' => $request->payment_status,
    //             'order_payment_status' => "Pending",
    //             'tran_ref' => "",
    //             'discount_amount' => $request->discount_amount,
    //             'total_amount' => $request->total_amount,
    //             'grand_total' => $request->grand_total,
    //             'vat_amount' => $vatPrice,
    //             'discount_code_coppen' => $request->discount_code_coppen,
    //             'shipping_amount' => $request->shipping_amount,
    //             'order_number' => $order_number,
    //             'arabic_switch' => $arabic_switch,
    //         ]);

    //         $order_id = order::where('customer_id', $customer_id)->orderBy('created_at', 'desc')->first()->id;
    //         $cartItems = Cart::with('product')->where('user_id', $user_id)->get();
    //         if($request->slug !=""){
    //             $quantity = $request->quantity;
    //             $slug = ($request->slug);
    //             $product = Product::where("slug",$slug)->first();
    //             order_product_quantity::create([
    //                 'order_id' =>  $order_id,
    //                 'product_id' =>  $product->id,
    //                 'quantity' => $quantity,
    //                 'serial_no' => "",
    //             ]);
    //             if ($product && $product->quantity >= $quantity) {
    //                 $product->quantity -= $quantity;
    //                 if ($product->quantity == 0) {
    //                     $product->availability = 'out-of-stock';
    //                 }
    //                 $product->save();
    //             }
    //         }
    //         else{
    //             foreach ($cartItems as $cartitem) {
    //                 order_product_quantity::create([
    //                     'order_id' =>  $order_id,
    //                     'product_id' =>  $cartitem->product_id,
    //                     'quantity' => $cartitem->quantity,
    //                     'serial_no' => "",
    //                 ]);

    //                 $product = Product::find($cartitem->product_id);
    //                 if ($product && $product->quantity >= $cartitem->quantity) {
    //                     $product->quantity -= $cartitem->quantity;
    //                     if ($product->quantity == 0) {
    //                         $product->availability = 'out-of-stock';
    //                     }
    //                     $product->save();
    //                 }
    //             }
    //         }
    //         if (empty($user_id)) {
    //             Cart::where('user_id', $without_user_add_to_Cart)->delete();
    //         } else {
    //             Cart::where('user_id', $user_id)->delete();
    //         }
    //         $discount_coupon = Session::get('discount_coupon');
    //         if ($discount_coupon) {
    //             $discount_coupon = discount::where('discount_coupon', $discount_coupon)->where('is_one_time', 1)->first();
    //             if ($discount_coupon) {
    //                 $discount_coupon->update(['is_one_time' => 2]);
    //             }
    //         }
    //         Session::put('order_number', $success->order_number);
    //         $invoice_no = '';
    //         if ($success->id > 100) {
    //             $invoice_no = '0' . $success->id;
    //         } elseif ($success->id > 1000) {
    //             $invoice_no = $success->id;
    //         } else {
    //             $invoice_no = '00' . $success->id;
    //         }
    //         if ($invoice_no != '') {
    //             $order = order::find($success->id);
    //             $order->invoice_no = $invoice_no;
    //             $order->update();
    //             $order = order::find($success->id);
    //             if ($order) {
    //                 $customerOrder = customer_order::find($customer_id);
    //                 if ($customerOrder) {
    //                     $customerOrder->order_number = $order_number;
    //                     $customerOrder->update();
    //                 }
    //                 $productQuantities = $order->productQuantity;
    //                 if ($productQuantities) {
    //                     $defaultManager = AccountManager::where('is_default_manager', 1)->first();
    //                     if($defaultManager){
    //                         $defaultManager_email = $defaultManager->email;
    //                         dispatch(new AdminOrderMailJob($order,$productQuantities,$defaultManager_email));
    //                     }
    //                     else{
    //                         dispatch(new AdminOrderMailJob($order,$productQuantities));
    //                     }
    //                     dispatch(new ClientOrderMailJob($order,$productQuantities));
    //                 }
    //             }
    //             try {
    //                 $response = $client->post('https://secure.clickpay.com.sa/payment/request', [
    //                     'headers' => [
    //                         'Authorization' => 'SMJNLWT69M-JHTGD2MZ6W-KWBLZ6NJ6R',
    //                         'Content-Type' => 'application/json',
    //                     ],
    //                     'json' => [
    //                         'profile_id' => '44531',
    //                         "tran_status" => "pending",
    //                         "tran_type" =>"sale",
    //                         "tran_class" => "ecom" ,
    //                         "cart_id" => "4244b9fd-c7e9-4f16-8d3c-4fe7bf6c48ca",
    //                         "cart_description" => "Dummy Order 35925502061445345",
    //                         "cart_currency" => "GBP",
    //                         'return_using_get' => true,
    //                         // 'return' =>  $returnUrl,
    //                         'cart_amount' => $request->grand_total,

    //                     ]
    //                 ]);
    //                 $paymentResponse = json_decode($response->getBody(), true);
    //                 Session::put('tran_ref',$paymentResponse['tran_ref']);
    //                 Session::put('profile_id',$paymentResponse['profile_id']);
    //                  return redirect($paymentResponse['redirect_url']);
    //             } catch (\Exception $e) {
    //                 dd(
    //                     $e->getMessage()
    //                 );
    //                 return redirect()->back()->with('error', 'An error occurred while processing your payment. Please try again later.');
    //             }
    //             // return redirect()->route('user.order_successfull');
    //         }

    //     }
    //     elseif($payment_method == "COD"){
    //         customer_order::create([
    //             'user_id' => $user_id,
    //             'first_name' => $request->first_name,
    //             'last_name' => $request->last_name,
    //             'company_name' => $request->company_name,
    //             'address' => $request->address,
    //             'without_user_id' => $without_user_add_to_Cart,
    //             'country' => $request->country,
    //             'region_state' => $request->region_state,
    //             'vat_reg_no' => $request->vat_reg_no,
    //             'company_reg_no' => $request->company_reg_no,
    //             'account_manager' => $request->account_manager,
    //             'additional_notes' => $request->additional_notes,
    //             'email' => $request->email,
    //             'phone_number' => $request->phone_number,
    //             'arabic_switch' => $arabic_switch,
    //         ]);

    //         $customer_id = customer_order::where('user_id', $user_id)->orderBy('created_at', 'desc')->first()->id;
    //         $order_number = "OS-" . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
    //         $vatPrice=$request->total_amount-$request->discount_amount;
    //         $vatPrice=$vatPrice* 0.15;
    //         $success = order::create([
    //             'customer_id' =>  $customer_id,
    //             'order_status' => 'New Order Placed',
    //             'payment_status' => $request->payment_status,
    //             'order_payment_status' => "Authorized",
    //             'tran_ref' => "",
    //             'discount_amount' => $request->discount_amount,
    //             'total_amount' => $request->total_amount,
    //             'grand_total' => $request->grand_total,
    //             'vat_amount' => $vatPrice,
    //             'discount_code_coppen' => $request->discount_code_coppen,
    //             'shipping_amount' => $request->shipping_amount,
    //             'order_number' => $order_number,
    //             'arabic_switch' => $arabic_switch,
    //         ]);

    //         $order_id = order::where('customer_id', $customer_id)->orderBy('created_at', 'desc')->first()->id;
    //         $cartItems = Cart::with('product')->where('user_id', $user_id)->get();
    //         if($request->slug !=""){
    //             $quantity = $request->quantity;
    //             $slug = ($request->slug);
    //             $product = Product::where("slug",$slug)->first();
    //             order_product_quantity::create([
    //                 'order_id' =>  $order_id,
    //                 'product_id' =>  $product->id,
    //                 'quantity' => $quantity,
    //                 'serial_no' => "",
    //             ]);
    //             if ($product && $product->quantity >= $quantity) {
    //                 $product->quantity -= $quantity;
    //                 if ($product->quantity == 0) {
    //                     $product->availability = 'out-of-stock';
    //                 }
    //                 $product->save();
    //             }
    //         }
    //         else{
    //             foreach ($cartItems as $cartitem) {
    //                 order_product_quantity::create([
    //                     'order_id' =>  $order_id,
    //                     'product_id' =>  $cartitem->product_id,
    //                     'quantity' => $cartitem->quantity,
    //                     'serial_no' => "",
    //                 ]);

    //                 $product = Product::find($cartitem->product_id);
    //                 if ($product && $product->quantity >= $cartitem->quantity) {
    //                     $product->quantity -= $cartitem->quantity;
    //                     if ($product->quantity == 0) {
    //                         $product->availability = 'out-of-stock';
    //                     }
    //                     $product->save();
    //                 }
    //             }
    //         }
    //         if (empty($user_id)) {
    //             Cart::where('user_id', $without_user_add_to_Cart)->delete();
    //         } else {
    //             Cart::where('user_id', $user_id)->delete();
    //         }
    //         $discount_coupon = Session::get('discount_coupon');
    //         if ($discount_coupon) {
    //             $discount_coupon = discount::where('discount_coupon', $discount_coupon)->where('is_one_time', 1)->first();
    //             if ($discount_coupon) {
    //                 $discount_coupon->update(['is_one_time' => 2]);
    //             }
    //         }
    //         Session::put('order_number', $success->order_number);
    //         $invoice_no = '';
    //         if ($success->id > 100) {
    //             $invoice_no = '0' . $success->id;
    //         } elseif ($success->id > 1000) {
    //             $invoice_no = $success->id;
    //         } else {
    //             $invoice_no = '00' . $success->id;
    //         }
    //         if ($invoice_no != '') {
    //             $order = order::find($success->id);
    //             $order->invoice_no = $invoice_no;
    //             $order->update();
    //             $order = order::find($success->id);
    //             if ($order) {
    //                 $customerOrder = customer_order::find($customer_id);
    //                 if ($customerOrder) {
    //                     $customerOrder->order_number = $order_number;
    //                     $customerOrder->update();
    //                 }
    //                 $productQuantities = $order->productQuantity;
    //                 if ($productQuantities) {
    //                     $defaultManager = AccountManager::where('is_default_manager', 1)->first();
    //                     if($defaultManager){
    //                         $defaultManager_email = $defaultManager->email;
    //                         dispatch(new AdminOrderMailJob($order,$productQuantities,$defaultManager_email));
    //                     }
    //                     else{
    //                         dispatch(new AdminOrderMailJob($order,$productQuantities));
    //                     }
    //                     dispatch(new ClientOrderMailJob($order,$productQuantities));
    //                 }
    //             }
    //             return redirect()->route('user.order_successfull');
    //         }
    //     }
    //     else{
    //     }
    // }
    // public function add_order_customer(Request $request)
    // {
    //     // dd($request->all());
    //     $validator = Validator::make($request->all(), [
    //         'first_name' => ['required', 'string', 'max:190'],
    //         'last_name' => ['required', 'string', 'max:190'],
    //         'address' => ['required', 'string', 'max:190'],
    //         'phone_number' => ['required', 'integer'],
    //         'email' => ['required', 'string', 'email', 'max:255'],
    //     ]);

    //     if ($validator->fails()) {
    //         Session::flash('error_message', '1');
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $payment_method = $request->payment_status;
    //     $user_id = Session::get('user_id');
    //     $without_user_add_to_Cart = empty($user_id) ? Session::get('without_user_add_to_Cart') : null;
    //     $arabic_switch = Session::get('arabic_switch');

    //     if ($payment_method == "Bank-Transfer" || $payment_method == "COD") {
    //         $customerOrderData = [
    //             'user_id' => $user_id,
    //             'first_name' => $request->first_name,
    //             'last_name' => $request->last_name,
    //             'company_name' => $request->company_name,
    //             'address' => $request->address,
    //             'without_user_id' => $without_user_add_to_Cart,
    //             'country' => $request->country,
    //             'region_state' => $request->region_state,
    //             'vat_reg_no' => $request->vat_reg_no,
    //             'company_reg_no' => $request->company_reg_no,
    //             'account_manager' => $request->account_manager,
    //             'additional_notes' => $request->additional_notes,
    //             'email' => $request->email,
    //             'phone_number' => $request->phone_number,
    //             'arabic_switch' => $arabic_switch,
    //         ];

    //         $customerOrder = customer_order::create($customerOrderData);
    //         $orderId = $customerOrder->id;
    //         $orderNumber = "OS-" . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
    //         $vatPrice = ($request->total_amount - $request->discount_amount) * 0.15;
    //         $orderData = [
    //             'customer_id' => $orderId,
    //             'order_status' => 'New Order Placed',
    //             'payment_status' => $payment_method,
    //             'order_payment_status' => ($payment_method == "COD") ? "Authorized" : "Pending",
    //             'tran_ref' => "",
    //             'discount_amount' => $request->discount_amount,
    //             'total_amount' => $request->total_amount,
    //             'grand_total' => $request->grand_total,
    //             'vat_amount' => $vatPrice,
    //             'discount_code_coppen' => $request->discount_code_coppen,
    //             'shipping_amount' => $request->shipping_amount,
    //             'order_number' => $orderNumber,
    //             'arabic_switch' => $arabic_switch,
    //         ];

    //         $order = order::create($orderData);

    //         $cartItems = Cart::with('product')->where('user_id', $user_id)->get();
    //         if($request->slug !=""){
    //             $quantity = $request->quantity;
    //             $slug = ($request->slug);
    //             $product = Product::where("slug",$slug)->first();
    //             order_product_quantity::create([
    //                 'order_id' =>  $order->id,
    //                 'product_id' =>  $product->id,
    //                 'quantity' => $quantity,
    //                 'serial_no' => "",
    //             ]);
    //             if ($product && $product->quantity >= $quantity) {
    //                 $product->quantity -= $quantity;
    //                 if ($product->quantity == 0) {
    //                     $product->availability = 'out-of-stock';
    //                 }
    //                 $product->save();
    //             }
    //         }
    //         else{
    //             foreach ($cartItems as $cartitem) {
    //                 order_product_quantity::create([
    //                     'order_id' =>  $order->id,
    //                     'product_id' =>  $cartitem->product_id,
    //                     'quantity' => $cartitem->quantity,
    //                     'serial_no' => "",
    //                 ]);

    //                 $product = Product::find($cartitem->product_id);
    //                 if ($product && $product->quantity >= $cartitem->quantity) {
    //                     $product->quantity -= $cartitem->quantity;
    //                     if ($product->quantity == 0) {
    //                         $product->availability = 'out-of-stock';
    //                     }
    //                     $product->save();
    //                 }
    //             }
    //         }
    //         if (empty($user_id)) {
    //             Cart::where('user_id', $without_user_add_to_Cart)->delete();
    //         } else {
    //             Cart::where('user_id', $user_id)->delete();
    //         }
    //         $discount_coupon = Session::get('discount_coupon');
    //         if ($discount_coupon) {
    //             $discount_coupon = discount::where('discount_coupon', $discount_coupon)->where('is_one_time', 1)->first();
    //             if ($discount_coupon) {
    //                 $discount_coupon->update(['is_one_time' => 2]);
    //             }
    //         }
    //         Session::put('order_number', $orderNumber);
    //         $defaultManager = AccountManager::where('is_default_manager', 1)->first();
    //         if ($defaultManager) {
    //             $defaultManager_email = $defaultManager->email;
    //             dispatch(new AdminOrderMailJob($order, $cartItems, $defaultManager_email));
    //         } else {
    //             dispatch(new AdminOrderMailJob($order, $cartItems));
    //         }
    //         dispatch(new ClientOrderMailJob($order, $cartItems));
    //         if ($payment_method == "Bank-Transfer") {
    //             $returnUrl = route('user.payment-success');
    //             $client = new Client();
    //             try {
    //                 $response = $client->post('https://secure.clickpay.com.sa/payment/request', [
    //                     'headers' => [
    //                         'Authorization' => 'SMJNLWT69M-JHTGD2MZ6W-KWBLZ6NJ6R',
    //                         'Content-Type' => 'application/json',
    //                     ],
    //                     'json' => [
    //                         'profile_id' => '44531',
    //                         "tran_status" => "pending",
    //                         "tran_type" => "sale",
    //                         "tran_class" => "ecom",
    //                         "cart_id" => "4244b9fd-c7e9-4f16-8d3c-4fe7bf6c48ca",
    //                         "cart_description" => "Dummy Order 35925502061445345",
    //                         "cart_currency" => "GBP",
    //                         'return_using_get' => true,
    //                         'return' => $returnUrl,
    //                         'cart_amount' => $request->grand_total,
    //                     ]
    //                 ]);
    //                 $paymentResponse = json_decode($response->getBody(), true);
    //                 Session::put('tran_ref', $paymentResponse['tran_ref']);
    //                 Session::put('profile_id', $paymentResponse['profileId']);
    //                 return redirect($paymentResponse['redirect_url']);
    //             } catch (\Exception $e) {
    //                 dd($e->getMessage());
    //                 return redirect()->back()->with('error', 'An error occurred while processing your payment. Please try again later.');
    //             }
    //         } elseif ($payment_method == "COD") {
    //             return redirect()->route('user.order_successfull');
    //         }
    //     }
    // }
    public function add_order_customer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:190'],
            'last_name' => ['required', 'string', 'max:190'],
            'address' => ['required', 'string', 'max:190'],
            'phone_number' => ['required','string','max:14'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        if ($validator->fails()) {
            Session::flash('error_message');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $payment_method = $request->payment_status;
        $user_id = Session::get('user_id');
        $without_user_add_to_Cart = empty($user_id) ? Session::get('without_user_add_to_Cart') : $user_id;
        Session::put('user_add_to_Cart', $without_user_add_to_Cart);
        Session::put('payment_method', $payment_method);
        Session::put('request', $request->all());

        if ($payment_method == "Debit-Credit") {
            try {
                $returnUrl = route('user.payment-success');
                $client = new Client();
                $response = $client->post('https://secure.clickpay.com.sa/payment/request', [
                    'headers' => [
                        'Authorization' => 'STJNLTTNLN-JHK9NBHJNM-ZBJNRWGM9N',
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'profile_id' => '44199',
                        "tran_status" => "pending",
                        "tran_type" => "sale",
                        "tran_class" => "ecom",
                        "cart_id" => "4244b9fd-c7e9-4f16-8d3c-4fe7bf6c48ca",
                        "cart_description" => "Dummy Order 35925502061445345",
                        "cart_currency" => "SAR",
                        'return_using_get' => true,
                        'return' =>  $returnUrl,
                        "customer_details" => [
                            'name' => $request->first_name . ' ' . $request->last_name,
                            "email" => $request->email,
                            "phone" => $request->phone_number,
                            "street1" => $request->address,
                            "city" => "Dubai",
                            "state" => "DU",
                            "country" => "AE",
                            "ip" => "127.0.0.1"
                        ],
                        "hide_shipping" => true,
                        'cart_amount' => $request->grand_total,

                    ]
                ]);
                $paymentResponse = json_decode($response->getBody(), true);
                Session::put('tran_ref', $paymentResponse['tran_ref']);
                Session::put('profile_id', $paymentResponse['profileId']);
                return redirect($paymentResponse['redirect_url']);
            } catch (\Exception $e) {
                // dd($e->getMessage());
                return redirect()->back()->with('error_message', 'An error occurred while processing your payment. Please try again later.',$e->getMessage());
            }
        } elseif ($payment_method == "COD" || $payment_method == "Bank-Transfer") {
            $order = $this->saveOrder();
            return redirect()->route('user.order_successfull');
        }
    }

    private function saveOrder($tran_ref = null, $order_payment_status = null)
    {
        $arabic_switch = Session::get('arabic_switch');
        $request = Session::get('request');
        $user_id = Session::get('user_id');
        $user_add_to_Cart = Session::get('user_add_to_Cart');
        $payment_method = Session::get('payment_method');
        $without_user_add_to_Cart = Session::get('without_user_add_to_Cart');
        if ($order_payment_status === null) {
            if ($payment_method == "COD" || $payment_method == "Bank-Transfer" ) {
                $order_payment_status = "Authorized";
            }
        }
        if ($tran_ref === null) {
            $tran_ref = "";
        }
        $customerOrderData = [
            'user_id' => $user_id,
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'company_name' => $request['company'],
            'address' => $request['address'],
            'without_user_id' => $without_user_add_to_Cart,
            'country' => $request['country'],
            'region_state' => $request['region_state'],
            'vat_reg_no' => $request['vat_reg_no'],
            'company_reg_no' => $request['company_reg_no'],
            'account_manager' => $request['account_manager'],
            'additional_notes' => $request['additional_notes'],
            'email' => $request['email'],
            'phone_number' => $request['phone_number'],
            'arabic_switch' => $arabic_switch,
        ];

        $customerOrder = customer_order::create($customerOrderData);
        $c_orderId = $customerOrder->id;
        $lastOrder = Order::orderBy('id', 'desc')->first();
        $lastOrderId = $lastOrder ? intval($lastOrder->id) : 1;
        $orderId = 1000 + $lastOrderId; 
        $orderNumber = "SO-" . str_pad($orderId, 4, '0', STR_PAD_LEFT);
        $vatPrice = ($request['total_amount'] - $request['discount_amount']) * 0.15;
        $orderData = [
            'customer_id' => $c_orderId,
            'order_status' => 'New Order Placed',
            'payment_status' => $payment_method,
            'order_payment_status' => $order_payment_status,
            'tran_ref' => $tran_ref,
            'discount_amount' => $request['discount_amount'],
            'total_amount' => $request['total_amount'],
            'grand_total' => $request['grand_total'],
            'vat_amount' => $vatPrice,
            'discount_code_coppen' => $request['discount_code_coppen'],
            'shipping_amount' => $request['shipping_amount'],
            'order_number' => $orderNumber,
            'arabic_switch' => $arabic_switch,
        ];

        $order = Order::create($orderData);
        // dd($order);
        $cartItems = Cart::with('product')->where('user_id', $user_id)->get();
        if ($request['slug'] != "") {
            $quantity = $request['quantity'];
            $slug = ($request['slug']);
            $product = Product::where("slug", $slug)->first();
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'user_id' => $user_add_to_Cart,
            ]);
            order_product_quantity::create([
                'order_id' =>  $order->id,
                'product_id' =>  $product->id,
                'quantity' => $quantity,
                'serial_no' => "",
            ]);
            if ($product && $product->quantity >= $quantity) {
                $product->quantity -= $quantity;
                if ($product->quantity == 0) {
                    $product->availability = 'out-of-stock';
                }
                $product->save();
            }
        } else {
            foreach ($cartItems as $cartitem) {
                order_product_quantity::create([
                    'order_id' =>  $order->id,
                    'product_id' =>  $cartitem->product_id,
                    'quantity' => $cartitem->quantity,
                    'serial_no' => "",
                ]);

                $product = Product::find($cartitem->product_id);
                if ($product && $product->quantity >= $cartitem->quantity) {
                    $product->quantity -= $cartitem->quantity;
                    if ($product->quantity == 0) {
                        $product->availability = 'out-of-stock';
                    }
                    $product->save();
                }
            }
        }
        $discount_coupon = Session::get('discount_coupon');
        if ($discount_coupon) {
            $discount_coupon = discount::where('discount_coupon', $discount_coupon)->where('is_one_time', 1)->first();
            if ($discount_coupon) {
                $discount_coupon->update(['is_one_time' => 2]);
            }
        }
        Session::put('order_number', $order->order_number);
        $invoice_no = '';
        if ($order->id > 100) {
            $invoice_no = '0' . $order->id;
        } elseif ($order->id > 1000) {
            $invoice_no = $order->id;
        } else {
            $invoice_no = '00' . $order->id;
        }
        if ($invoice_no != '') {
            $order = order::find($order->id);
            $order->invoice_no = $invoice_no;
            $order->update();
            $order = order::find($order->id);
        }
        $this->sendOrderEmails($order);
        return $order;
    }
    private function sendOrderEmails($order)
    {
        $user_id = Session::get('user_add_to_Cart');
        $cartItems = Cart::with('product')->where('user_id', $user_id)->get();
        $defaultManager = AccountManager::where('is_default_manager', 1)->first();

        if ($defaultManager) {
            $defaultManager_email = $defaultManager->email;
            dispatch(new AdminOrderMailJob($order, $cartItems, $defaultManager_email));
        } else {
            dispatch(new AdminOrderMailJob($order, $cartItems));
        }
        dispatch(new ClientOrderMailJob($order, $cartItems));
        if($user_id){
            $orders =  Cart::where('user_id', $user_id)->get();
            foreach($orders as $order){
              $order->delete();
            }
         }
        Session::forget('request');
    }
    public function payment_success(Request $request)
    {
        $previous_url = Session::get('_previous');
        $tran_ref = Session::get('tran_ref');
        $profile_id = Session::get('profile_id');
        $order_number = Session::get('order_number');
        try {
            $client = new Client();
            $response = $client->post('https://secure.clickpay.com.sa/payment/query', [
                'headers' => [
                    'Authorization' => 'STJNLTTNLN-JHK9NBHJNM-ZBJNRWGM9N',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'tran_ref' => $tran_ref,
                    'profile_id' => $profile_id,
                ]
            ]);
            $transactionDetails = json_decode($response->getBody(), true);
            $response_message = strtolower($transactionDetails['payment_result']['response_message']);
            Session::put('payment_status', $response_message);
            if ($response_message === 'authorised') {
                $this->saveOrder($tran_ref ,$response_message );
                return redirect()->route('user.order_successfull');
            } else {
                Session::forget('tran_ref');
                Session::forget('payment_status');
                Session::flash('error_message', $response_message);
                return redirect()->back();
            }
        } catch (RequestException $e) {
            return redirect()->back()->with('error_message', 'An error occurred while processing your payment. Please try again later.',$e->getMessage());
        }
    }
}
