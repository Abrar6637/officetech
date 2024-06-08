<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\addCategories;
use App\Models\Admin\Region;
use Illuminate\Support\Str;
use App\Models\Admin\Reviews;
use App\Models\Admin\Services;
use App\Models\brands;
use App\Models\categories;
use App\Models\Product;
use App\Models\Admin\AccountManager;
use App\Models\Admin\Country;
use App\Models\Admin\PrivacyPolicy;
use App\Models\Admin\ReturnPolicy;
use App\Models\Admin\ServicePolicy;
use App\Models\Admin\ServicePlanPolicy;
use App\Models\Admin\PaymentPolicy;
use App\Models\Admin\EcomPrintPackage;
use App\Models\Admin\AboutUs;
use App\Models\trackorder;
use App\Models\sub_main_category;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\customer_order;
use App\Models\order;
use App\Models\Admin\Slider;
use App\Models\User;
use App\Models\UserAccountDetails;
use App\Models\UserBillingDetails;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function admin()
    {
        return view('frontend.user.index');
    }
    public function index()
    {
        $sliders = Slider::where ('status', '1')->get();
        $brands = brands::all();
        $reviews = Reviews::where('status', '1')->orderBy('id', 'desc')->take(6)->get();
        $products = Product::with('gallery_images')
        ->where('status', '1') 
        ->orderBy('id', 'desc')
        ->take(15)
        ->get();

        // $latestProducts = Product::with('gallery_images')->where('status','1')->orderBy('id', 'desc')->take(15)->get();
        return view('frontend.user.index')
            ->with('brands', $brands)
            ->with('sliders', $sliders)
            ->with('reviews', $reviews)
            ->with('products', $products);

    }
    public function about_us()
    {
        $aboutUs = AboutUs::where('status', true)->first();
        return view('frontend.user.about_us', compact('aboutUs'));
    }
    public function accessories()
    {

        return view('frontend.user.accessories');
    }
    public function signin(Request $request)
    {
        return view('frontend.user.sign-in');
    }
    public function signup()
    {
        return view('frontend.user.sign-up');
    }
    public function cart(Request $request)
    {
        $product_slug = $request->slug;
        $slug = null;
        $slug =$product_slug; 
        $user_id = Session::get('user_id');
        $subtotal = 0;
        $discount = 0;
        if($slug == null) {
            if (empty($user_id)) {
                $user_id = Session::get('without_user_add_to_Cart');
            }
            $cartItems = Cart::with('product')->where('user_id', $user_id)->get();
            foreach ($cartItems as $cartItem) {
                if ($cartItem->product->sale_price) {
                    $productPrice = $cartItem->product->sale_price;
                } else {
                    $productPrice = $cartItem->product->price;
                }
                $quantity = $cartItem->quantity;
                $subtotal += $productPrice * $quantity;
            }
            $total = $subtotal - $discount;
            return view('frontend.user.cart', compact('cartItems', 'subtotal', 'total', 'discount', 'user_id','slug'));
        }else{
            if (empty($user_id)) {
                $user_id = Session::get('without_user_add_to_Cart');
            }
            $cartItem  = Product::where("slug",$slug)->first();
            if ($cartItem ->sale_price) {
                $productPrice = $cartItem ->sale_price;
            } else {
                $productPrice = $cartItem ->price;
            }
            $quantity = 1;
            $subtotal += $productPrice * $quantity;
            $total = $subtotal - $discount;
            $cartItems = [$cartItem];
            return view('frontend.user.cart', compact('cartItems', 'subtotal', 'total', 'discount', 'user_id','slug'));
        }

    }
    public function contact_us()
    {

        return view('frontend.user.contact-us');
    }
    public function forget_password()
    {
        return view('frontend.user.forget-password');
    }
    public function forget_password_link(Request $request):RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);
        Mail::send('frontend.Email.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return back()->with('message', 'We have e-mailed your password reset link!');
    }
    public function showResetPasswordForm($token)
    { 
       return view('frontend.user.forgetPasswordLink', ['token' => $token]);
    }
    public function submitResetPasswordForm(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:4|confirmed',
            'password_confirmation' => 'required'
        ]);
        $updatePassword = DB::table('password_resets')
                            ->where([
                              'email' => $request->email, 
                              'token' => $request->token
                            ])
                            ->first();
        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('/sign-in')->with('message', 'Your password has been changed!');
    }
    public function printers()
    {
        return view('frontend.user.printers');
    }
    public function product_details($slug)
    {
        $user_id = Session::get('user_id');
        $without_user_add_to_Cart = Session::get('without_user_add_to_Cart');
        $product_details = Product::where('slug', $slug)->first();
        if ($product_details) {
            $brand_id = $product_details->brand->id;
            $subcategory_id = $product_details->sub_categories_id;
            $related_products = Product::where('brand_id', $brand_id)
                ->where('status', '1')
                ->where('id', '!=', $product_details->id)
                ->get();
            $productId = $product_details->id;
        }
        $reviews = Reviews::where('product_id', $productId)->where('status', 1)->get();
        $totalReviews = count($reviews);
        $averageRating = $totalReviews > 0 ? $reviews->avg('rating') : 0;
        return view('frontend.user.product-details')
            ->with('product_details', [$product_details])
            ->with('user_id', $user_id)
            ->with('reviews', $reviews)
            ->with("without_user_add_to_Cart",$without_user_add_to_Cart)
            ->with('averageRating', $averageRating)
            ->with('related_products', $related_products);
    }
    public function reset_password()
    {
        return view('frontend.user.reset-password');
    }
    public function services()
    {
        $reviews = Reviews::where('status', 1)->orderBy('id', 'desc')->take(6)->get();


        return view('frontend.user.services', compact('reviews'));
    }
    public function software_solutions()
    {

        return view('frontend.user.software');
    }
    public function user_setting()
    {
        $user_id = Session::get('user_id');
        $order = customer_order::where('user_id', $user_id)->first();
        $user_billing_details = UserBillingDetails::where('user_id', $user_id)->first();
        $countries = Country::where('status', '1')->get();
        $account_manager = AccountManager::where('status', '1')->get();
        $regions = Region::where('status', '1')->get();
        $user_details = "";
        if ($order) {
            $user_details = $order;
        } else if ($user_billing_details) {
            $user_details = $user_billing_details;
        }
        $user_account_details = UserAccountDetails::where('user_id', $user_id)->first();
        $user = User::where('id', $user_id)->first();
        return view('frontend.user.user-setting', compact('user_details', 'user_account_details', 'user_billing_details', 'user', 'countries', 'account_manager', 'regions'));
    }
    public function track_order_details(Request $request)
    {
        $order_number = $request->order_number;
        $billing_email = $request->billing_email;
        $trackOrders = TrackOrder::where('order_number', $order_number)
            ->where('billing_email', $billing_email)
            ->orderBy('created_at', 'desc')
            ->get();
        if ($trackOrders->count() > 0) {
            $region_state = $trackOrders->first()->customer->region_state;
            $region_details = Region::where('name', $region_state)->first();
            return view('frontend.user.track-order-details')->with([
                'trackOrders' => $trackOrders,
                'region_details' => $region_details,
            ]);
        } else {
            return redirect()
                ->route('user.track_order')
                ->with('error', "No tracking information available for order number $order_number. Your order may still be processing. Please check again later.");
        }
    }
    public function work_station()
    {

        return view('frontend.user.work-station');
    }
    public function track_order()
    {
        if (Session::get('user_authenticated')) {
            $user_id = Session::get('user_id');
            if ($user_id) {
                return view('frontend.user.track-order');
            }
        } else {
            return redirect()->route('user.signin')->with('login_error', 'You need to login to track order');
        }
    }
    public function orders()
    {
        if (Session::get('user_authenticated')) {
            $user_id = Session::get('user_id');
            if ($user_id) {
                $orders = order::orderBy('created_at', 'desc')->with('productQuantity.product')->get();
                // dd($orders);
                $order_details = customer_order::orderBy('created_at', 'desc')->where('user_id', $user_id)->get();
                return view('frontend.user.my-orders')
                    ->with('customer_orders', $orders)
                    ->with('order_details', $order_details);
            }
        } else {
            return redirect()->route('user.signin');
        }
    }

    public function order_status()
    {

        return view('frontend.user.track-order');
    }
    public function order_successfull()
    {
        Session::forget('discount_amount');
        Session::forget('discount_coupon');
        $orderNumber = session('order_number');
        return view('frontend.user.successfull-order')->with('orderNumber', $orderNumber);
    }
    public function checkout(Request $request)
    {
        $defaultManager = AccountManager::where('is_default_manager', 1)->first();
        $user_id = Session::get('user_id');
        $user_details = "";
        if (empty($user_id)) {
            $user_id = Session::get('without_user_add_to_Cart');
        }
        $order = customer_order::where('user_id', $user_id)->first();
        $userBillingDetails = UserBillingDetails::where('user_id', $user_id)->first();
        if ($order) {
            $user_details = $order;
        } else if ($userBillingDetails) {
            $user_details = $userBillingDetails;
        }
        // dd($user_id);
        $discount_amount = null;
        $product_quantity = false;
        $product_name = "";
        $subtotal = 0;
        $totalPrice = 0;
        $discount_coupon = null;
        $regions = Region::where('status', '1')->get();
        $countries = Country::where(['status' => '1', 'is_default_country' => '1'])->get();
        if($request->has('slug')){
            $slug = decrypt($request->slug);
            $cartItem  = Product::where("slug",$slug)->first();
            if ($cartItem->sale_price) {
                $productPrice = $cartItem->sale_price;
            } else {
                $productPrice = $cartItem->price;
            }
            $quantity =($request->updated_qty);
            $subtotal += $productPrice * $quantity;
            $totalPrice = $subtotal;
            $cartItems = [$cartItem];
            if (session()->has('discount_amount')) {
                $discount_amount = Session::get('discount_amount');
                $discount_coupon = Session::get('discount_coupon');
                $totalPrice = $subtotal - $discount_amount;
            }
            return view('frontend.user.checkout', compact('product_quantity', 'product_name', 'cartItems', 'subtotal', 'discount_amount', 'totalPrice', 'user_id', 'discount_coupon', 'user_details', 'regions', 'defaultManager', 'countries','slug','quantity'));

        }else{
            $cartItems = Cart::with('product')->where('user_id', $user_id)->get();
            foreach ($cartItems as $cartItem) {
                if ($cartItem->product->sale_price) {
                    $productPrice = $cartItem->product->sale_price;
                } else {
                    $productPrice = $cartItem->product->price;
                }
                $quantity = $cartItem->quantity;
                if ($cartItem->product->quantity == 0) {
                    $product_quantity = true;
                    $product_name = $cartItem->product->name;
                }
                $subtotal += $productPrice * $quantity;
                $totalPrice = $subtotal;
            }
            if (session()->has('discount_amount')) {
                $discount_amount = Session::get('discount_amount');
                $discount_coupon = Session::get('discount_coupon');
                $totalPrice = $subtotal - $discount_amount;
            }
            if (count($cartItems) == 0) {
                return redirect()->back();
            }
            $slug =NULL;
            $quantity = 0;
            return view('frontend.user.checkout', compact('product_quantity', 'product_name', 'cartItems', 'subtotal', 'discount_amount', 'totalPrice', 'user_id', 'discount_coupon', 'user_details', 'regions', 'defaultManager', 'countries','slug','quantity'));            
        }
  
    }
    public function error()
    {

        return view('frontend.user.404-page');
    }
    public function user_logout()
    {
        Session::forget('discount_amount');
        Session::forget('discount_coupon');
        Session::forget('user_authenticated');
        Session::forget('user_id');
        Session::forget('user_name');
        Session::forget('user_email');
        return redirect('/sign-in');
    }
    public function header()
    {
        return view('frontend.layout.header');
    }
    public function featured_product()
    {
        $featured = Product::with('gallery_images')->where('featured_product', 1)->get();
        return response()->json(['data' => $featured]);
    }
    public function recommended_product()
    {
        $recommended = Product::with('gallery_images')->where('recommended', 1)->get();
        return response()->json(['data' => $recommended]);
    }
    public function latest_products()
    {
        $latestProducts = Product::with('gallery_images')->orderBy('id', 'desc')->take(8)->get();
        return response()->json(['data' => $latestProducts]);
    }
    public function loadMoreReviews($productId, $page)
    {
        return response()->json([
            'success' => true,
            'productID' => $productId,
            'page' => $page
        ]);
    }
    public function service($orderId)
    {

        $orderId = decrypt($orderId);
        if (Session::get('user_authenticated')) {
            $user_id = Session::get('user_id');
            if ($user_id) {
                $services = Services::all();
                $orders = order::orderBy('created_at', 'desc')->where('id', $orderId)->with('productQuantity.product')->get();
                return view('frontend.user.choose-service')
                    ->with('orderId', $orderId)
                    ->with('services', $services)
                    ->with('orders', $orders);
            }
        } else {
            return redirect()->route('user.signin');
        }
    }
    public function admin_request_email()
    {
        return view('frontend.Email.client-return-request');
    }
    public function vatCertificate()
    {
        return view('frontend.user.Policy-Pages.vat-certificate');
    }
    public function termsConditions()
    {
        return view('frontend.user.Policy-Pages.terms&conditions');
    }
    public function paymentPolicy()
    {
        $paymentPolicy = PaymentPolicy::where('status', true)->first();
        return view('frontend.user.Policy-Pages.payment-policy', compact('paymentPolicy'));
    }
    public function servicePlansPolicy()
    {
        $servicePlanPolicy = ServicePlanPolicy::where('status', true)->first();
        return view('frontend.user.Policy-Pages.service-plans', compact('servicePlanPolicy'));
    }

    public function servicePolicy()
    {
        $servicePolicy = ServicePolicy::where('status', true)->first();
        return view('frontend.user.Policy-Pages.service-policy', compact('servicePolicy'));
    }
    public function privacyPolicy()
    {
        $privacyPolicy = PrivacyPolicy::where('status', true)->first();
        return view('frontend.user.Policy-Pages.privacy-policy', compact('privacyPolicy'));
    }
    public function return_policy()
    {
        $returnPolicy = ReturnPolicy::where('status', true)->first();
        return view('frontend.user.Policy-Pages.return-policy', compact('returnPolicy'));
    }
    public function ecomPrintPackage()
    {
        $ecomPrintPackage = EcomPrintPackage::where('status', true)->first();
        return view('frontend.user.Policy-Pages.ecom-print-package', compact('ecomPrintPackage'));
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
        $shippingAmount = $shipping->shipping_type === '0' ? $shipping->amount : ($subtotal * $shipping->amount / 100);
        if ($discountAmount) {
            $subtotal -= $discountAmount;
        }
        $subtotal = floatval($subtotal);
        $shippingAmount = floatval($shippingAmount);
        $grandTotal = $subtotal + $shippingAmount;
        return response()->json(['shippingAmount' => $shippingAmount, 'grandTotal' => $grandTotal, 'DiscountAmount' => $discountAmount]);
    }
    public function old_page()
    {
        $sliders = Slider::all();
        $brands = brands::all();
        $reviews = Reviews::where('status', '1')->orderBy('id', 'desc')->take(6)->get();
        return view('frontend.user.index')


            ->with('brands', $brands)
            ->with('sliders', $sliders)
            ->with('reviews', $reviews);
    }
}
