<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\Quotation\AdminQuotaionJob;
use App\Jobs\Quotation\ClientQuotaionJob;
use App\Models\Admin\AccountManager;
use App\Models\Cart;
use App\Models\Product;
use App\Models\RequestQuotation;
use App\Models\RequestQuotationProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequestQuotationController extends Controller
{
    //
    public function generateRequestQuotation(Request $request, $userId)
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }
        $id = $userId;
        $slug = $request->slug;
        if($slug !=NULL){
            $product = Product::where('slug', $slug)->first(); ;
            Cart::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'quantity' => $request->buy_now_qty,
            ]);

        }
        $request_quotation = RequestQuotation::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_id' => $id,
            'email' => $request->email,
            'shipping_amount' => $request->shipping_amount,
            'discount_amount' => $request->discount_amount,
            'total_amount' => $request->total_amount,
            'grand_total' => $request->new_total_amount,
            'address' => $request->address,
            'account_manager' => $request->selectedManager,
            'added_by' => $request->added_by,
            'vat_amount' => $request->vat_amount,
            'region_state' => $request->selectedRegion,
            'discount_code_coppen' => $request->discount_coupon_name,
        ]);

        $carts = Cart::with('product')->where('user_id', $id)->get();

        foreach ($carts as $cart) {
            $product = $cart->product;
            RequestQuotationProduct::create([
                'quotation_id' => $request_quotation->id,
                'product_name' => $product->name,
                'product_price' => $product->price,
                'product_quantity' => $cart->quantity,
                'product_id'=>$product->id,
            ]);
        }

        $billingInfo = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address' => $request->address,
            'discount_amount' => $request->discount_amount,
            'shipping_amount' => $request->shipping_amount,
            'total_amount' => $request->total_amount,
            'grand_total' => $request->new_total_amount,
            'region_name' => $request->selectedRegion,
            'account_manager' => $request->selectedManager ,
            'discount_coupon_name' => $request->discount_coupon_name,
        ];

        $defaultManager = AccountManager::where('is_default_manager', 1)->first();
        if ($defaultManager) {
            $defaultManager_email = $defaultManager->email;
            dispatch(new AdminQuotaionJob($carts, $billingInfo, $defaultManager_email));
        } else {
            dispatch(new AdminQuotaionJob($carts, $billingInfo));
        }
        dispatch(new ClientQuotaionJob($carts, $billingInfo));
        $response = [
            'success' => true,
            'message' => 'Quotation request successful',
            'quotation_details' => $request_quotation,
            'billing_info' => $billingInfo,
            'cart_details' => $carts,
            'redirect_url' => route('frontend.request_quotation'),
        ]; 
        session()->put('carts', $carts);
        session()->put('billingInfo', $billingInfo);
        if($slug !=NULL){
            if($userId){
                Cart::where('user_id', $userId)->delete();
            }

        }
        if ($request->ajax()) {
            return response()->json($response, 200);
        }
        $redirectUrl = route('frontend.request_quotation', [
            'carts' => $carts,
            'billingInfo' => $billingInfo,
        ]);
        return redirect($redirectUrl)->with($response);
    }
    public function RequestQuotation(Request $request){
        $carts = session()->get('carts', collect());
        $billingInfo = session()->get('billingInfo', []);
        return view('frontend.request_quotation.request_quotation', ['carts' => $carts, 'billingInfo' => $billingInfo]);
    }
    public function clearSession(Request $request)
    {
        $request->session()->forget(['carts', 'billingInfo']);
        return response()->json(['message' => 'Session cleared successfully']);
    }

}
