<?php

namespace App\Http\Controllers\Admin\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Show the products and cart
    public function showProducts()
    {
        $products = Product::where('status', 1)->get();
        $cartItems = session('cart', []);

        return view('frontend.user.products', compact('products', 'cartItems'));
    }

    public function remove_Cart(Request $request)
    {
        $id = $request->id;
        Cart::where('id', $id)->delete();
        return redirect()->route('user.cart');
    }

    public function delete_all_cart()
    {
        $user_id = Session::get('user_id');

        if (empty($user_id)) {
            $user_id = Session::get('without_user_add_to_Cart');
        } 
        Cart::where('user_id', $user_id)->delete();
        return redirect()->back();
    }

    // Add a product to the cart
    public function addToCart(Request $request)
    {
        $user_id = $request->user_id;
        $productId = $request->productId;
        $quantity = $request->quantity;
        $product = Product::findOrFail($productId);
        $cart = Cart::where('user_id', $user_id)->where('product_id', $productId)->first();
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        if ($cart == "") {
            Cart::create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'ip_address' => $request->ip(),
                'user_id' => $user_id,
            ]);
            return response()->json([
                'success' => true,
                'new_Cart' => "1",
            ]);
            return response()->json(['success' => true]);
        } else {
            $cartItem = Cart::where('product_id', $productId)->where('user_id', $user_id)->first();
            if ($cartItem) {
                $cartItem->quantity += 1;
                $cartItem->save();
                return response()->json([
                    'success' => true,
                    'new_Cart' => "0",
                ]);
            }
            return response()->json(['success' => false]);
        }
    }
    public function update_Cart(Request $request)
    {
        $subtotal = 0;
        $user_id = $request->user_id;
        $productId = $request->productId;
        $newQuantity = $request->quantity;
        $discount = 0;
        $cartItem = Cart::where('product_id', $productId)->where('user_id', $user_id)->first();
        if ($cartItem) {
            $cartItem->quantity = $newQuantity;
            $cartItem->save();

            $cartItems = Cart::with('product')->where('user_id', $user_id)->get();
            foreach ($cartItems as $cartItem) {
                if($cartItem->product->sale_price){
                $productPrice = $cartItem->product->sale_price;
                }else{
                $productPrice = $cartItem->product->price;
                }
                $subtotal += $productPrice * $cartItem->quantity;
            }
            $total = $subtotal - $discount;

            return response()->json([
                'success' => true,
                'subtotal' => $subtotal,
                'total' => $total,
                'discount' => $discount,
            ]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function showquantity(Request $request)
    {
        $user_id = $request->user_id;
        $cart = Cart::where('user_id', $user_id)->get();
        return response()->json(['data' => $cart]);
    }

    public function discount_card(Request $request)
    {
        $totalAmount = $request->totalAmount; 
        $discountcoupon = discount::where('discount_coupon', $request->discount_coupon)->first();

        if ($discountcoupon) {
            if (now()->between($discountcoupon->start_date, $discountcoupon->end_date) && $discountcoupon->is_one_time!=2) {
                $discount_amount = $discountcoupon->discount;
                $discount_type = $discountcoupon->discount_type;
                if ($discount_type === 'Percentage') {
                    $discount_amount = ($discount_amount / 100) * $totalAmount;
                    $totalAmount=$totalAmount-$discount_amount;
                }else{
                    $totalAmount = $totalAmount - $discount_amount;
                }
                Session::put('discount_amount', $discount_amount);
                Session::put('discount_coupon', $request->discount_coupon);
                return response()->json([
                    'success' => true,
                    'total' => $totalAmount,
                    'discount' => $discount_amount,
                    'coupon_name' => $discountcoupon->discount_coupon,
                ]);
            } else {
                Session::forget('discount_amount');
                Session::get('discount_coupon');
                return response()->json([
                    'success' => false,
                    'message' => 'Discount code is expired.',
                ]);
            }
        } else {
            Session::forget('discount_amount');
            Session::get('discount_coupon');
            return response()->json([
                'success' => false,
                'message' => 'Discount code not found.',
            ]);
        }
    }
    public function getTotalCartCount(Request $request)
    {
        $user_id = $request->input('user_id');
        $totalCount = Cart::where('user_id', $user_id)->distinct('product_id')->count('product_id');
        return response()->json([
            'success' => true,
            'totalCount' => $totalCount,
        ]);
    }
}
