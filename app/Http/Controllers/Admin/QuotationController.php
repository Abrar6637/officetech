<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\AdminQuotation\AdminSideClientQuotationJob;
use App\Jobs\AdminQuotation\AdminSideQuotationJob;
use App\Jobs\AdminQuotation\AdminSideUpdateClientQuotationJob;
use App\Jobs\AdminQuotation\AdminSideUpdateQuotationJob;
use App\Models\Admin\AccountManager;
use App\Models\Admin\Region;
use App\Models\Product;
use App\Models\RequestQuotation;
use App\Models\RequestQuotationProduct;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    //
    public function index()
    {
        $quotation_details = RequestQuotation::with('products')->where('added_by', '!=', 'admin')->get();
        // dd($quotation_details);
        return view('admin.quotations.index', compact('quotation_details'));
    }

    public function show($id)
    {
        $quotation_details = RequestQuotation::with('products.product')->where('id', $id)->first();
        return view('admin.quotations.quotation_detail', compact('quotation_details'));
    }

    public function edit($id)
    {
        $orderProducts = RequestQuotation::with('products.product')->where('id', $id)->first();
        $regions = Region::where('status','1')->get();
        $AccountManagers = AccountManager::all();
        if ($orderProducts) {
            $productIds = $orderProducts->products->pluck('product_id')->toArray();
            $productIdsString = implode(',', $productIds);
        }
        $products = Product::all();
        return view('admin.quotations.edit', compact('orderProducts', 'products','productIdsString','regions','AccountManagers'));
    }
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $productQuantities = $request->input('quantity');
        $product_ids = $request->input('product_ids');
        $productIdsArray = array_reverse(explode(',', $product_ids));
        $quantityCollection = array_combine($productIdsArray, $productQuantities);
        $productDetails = Product::whereIn('id', explode(',', $product_ids))->get(['id', 'name', 'price']);
        RequestQuotation::find($id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'shipping_amount' => $request->shipping_amount,
            'discount_amount' => $request->discount_amount,
            'total_amount' => $request->new_subtotal,
            'grand_total' => $request->new_total_amount,
            'address' => $request->address,
            'account_manager' => $request->account_manager,
            'vat_amount' => $request->vat_amount,
            'region_state' => $request->region_state,
            'discount_code_coppen' => $request->coupon_name,
        ]);
        RequestQuotationProduct::where('quotation_id', $id)->delete();
        foreach ($productDetails as $productDetail) {
            $productId = $productDetail->id;
            $productName = $productDetail->name;
            $productPrice = $productDetail->price;
            RequestQuotationProduct::create([
                'quotation_id' => $id,
                'product_id' => $productId,
                'product_name' => $productName,
                'product_price' => $productPrice,
                'product_quantity' => $quantityCollection[$productId],
            ]);
        }
        $mergedProducts = RequestQuotationProduct::where('quotation_id', $id)->get();
        $acount_manager = AccountManager::where('name', $request->account_manager)->first();
        $request_quotation = RequestQuotation::with('products.product')->where('id', $id)->first();
        if($acount_manager){
            $account_manager_email = $acount_manager->email;
            dispatch(new AdminSideUpdateQuotationJob($request_quotation, $mergedProducts,$account_manager_email));
        }else{
            dispatch(new AdminSideUpdateQuotationJob($request_quotation, $mergedProducts));
        }
        dispatch(new AdminSideUpdateClientQuotationJob($request_quotation, $mergedProducts));
        return redirect()->route('admin.quotations');
    }

    public function delete($id)
    {
        RequestQuotation::find($id)->delete();
        return redirect()->route('admin.quotations')->with('danger', 'Quotation deleted successfully');
    }

    public function indexAdminQuotation()
    {
        $quotation_details = RequestQuotation::with('products')->where('added_by', '=', 'admin')->get();
        return view('admin.admin-quotation.index', compact('quotation_details'));
    }

    public function createAdminQuotation()
    {
        $users = User::all();
        $regions = Region::where('status','1')->get();
        $AccountManagers = AccountManager::all();
        $products = Product::where('status', '1')->get();
        // dd($users);
        return view('admin.admin-quotation.create', compact('users', 'products','regions','AccountManagers'));
    }

    public function storeAdminQuotation(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::find($user_id);
        // dd($user);

        // $request_quotation = RequestQuotation::create([
        //     'user_id' => $request->user_id,
        //     'first_name' => $request->name,
        //     'last_name' => null,
        //     'address' => $request->address ?? '',
        //     'email' => $request->email,
        //     'added_by' => $request->added_by,
        //     'discount_amount' => $request->discount_amount,
        // ]);

        $request_quotation = RequestQuotation::create([
            'first_name' => $request->name,
            'last_name' => null,
            'user_id' => $request->user_id,
            'email' => $request->email,
            'shipping_amount' => $request->shipping_amount,
            'discount_amount' => $request->discount_amount,
            'total_amount' => $request->subtotal,
            'grand_total' => $request->new_total_amount,
            'address' => $request->address,
            'account_manager' => $request->account_manager,
            'address' => $request->address ?? '',
            'vat_amount' => $request->vat_amount,
            'region_state' => $request->region_state,
            'discount_code_coppen' => $request->coupon_name,
            'added_by' => $request->added_by,
        ]);
        $productQuantities = $request->input('product_quantity');
        $productNames = $request->input('product_names');
        $productPrices = $request->input('product_prices');
        $product_ids = explode(',', $request->product_ids);
        foreach ($productQuantities as $key => $quantity) {
            $productName = $productNames[$key];
            $productPrice = $productPrices[$key];
            $productId = $product_ids[$key];

            $productData = [
                'quotation_id' => $request_quotation->id,
                'product_quantity' => $quantity,
                'product_name' => $productName,
                'product_price' => $productPrice,
                'product_id' => $productId,
            ];
            RequestQuotationProduct::create($productData);
        }
        $mergedProducts = [];

        for ($i = 0; $i < count($productQuantities); $i++) {
            $mergedProducts[] = [
                'product_quantity' => $productQuantities[$i],
                'product_name' => $productNames[$i],
                'product_price' => $productPrices[$i],
            ];
        }
        $request_quotation = RequestQuotation::with('products.product')->where('id', $request_quotation->id)->first();
        $acount_manager = AccountManager::where('name', $request->account_manager)->first();
        if($acount_manager){
            $account_manager_email = $acount_manager->email;
            dispatch(new AdminSideQuotationJob($request_quotation, $mergedProducts,$account_manager_email));
        }else{
            dispatch(new AdminSideQuotationJob($request_quotation, $mergedProducts));
        }
        dispatch(new AdminSideClientQuotationJob($request_quotation, $mergedProducts, $user));
        return redirect()->route('admin.index.quotation')->with('success', 'Admin Quotation created successfully');
    }

    public function editAdminQuotation($id)
    {
        $orderProducts = RequestQuotation::with('products.product')->where('id', $id)->first();
        $regions = Region::where('status','1')->get();
        $AccountManagers = AccountManager::all();
        if ($orderProducts) {
            $productIds = $orderProducts->products->pluck('product_id')->toArray();
            $productIdsString = implode(',', $productIds);
        }
        $products = Product::all();
        return view('admin.admin-quotation.edit',compact('orderProducts', 'products','productIdsString','regions','AccountManagers'));
    }

    public function showAdminQuotation($id)
    {
        $quotation_details = RequestQuotation::with('products')->where('id', $id)->first();
        return view('admin.admin-quotation.quotation_detail', compact('quotation_details'));
    }

    public function updateAdminQuotation(Request $request, $id)
    {
        // dd($request->all());
        $productQuantities = $request->input('quantity');
        $product_ids = $request->input('product_ids');
        $productIdsArray = array_reverse(explode(',', $product_ids));
        $quantityCollection = array_combine($productIdsArray, $productQuantities);
        $productDetails = Product::whereIn('id', explode(',', $product_ids))->get(['id', 'name', 'price']);
        RequestQuotation::find($id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'shipping_amount' => $request->shipping_amount,
            'discount_amount' => $request->discount_amount,
            'total_amount' => $request->new_subtotal,
            'grand_total' => $request->new_total_amount,
            'address' => $request->address,
            'account_manager' => $request->account_manager,
            'vat_amount' => $request->vat_amount,
            'region_state' => $request->region_state,
            'discount_code_coppen' => $request->coupon_name,
        ]);
        RequestQuotationProduct::where('quotation_id', $id)->delete();
        foreach ($productDetails as $productDetail) {
            $productId = $productDetail->id;
            $productName = $productDetail->name;
            $productPrice = $productDetail->price;
            RequestQuotationProduct::create([
                'quotation_id' => $id,
                'product_id' => $productId,
                'product_name' => $productName,
                'product_price' => $productPrice,
                'product_quantity' => $quantityCollection[$productId],
            ]);
        }
        $mergedProducts = RequestQuotationProduct::where('quotation_id', $id)->get();
        $acount_manager = AccountManager::where('name', $request->account_manager)->first();
        $request_quotation = RequestQuotation::with('products.product')->where('id', $id)->first();
        if($acount_manager){
            $account_manager_email = $acount_manager->email;
            dispatch(new AdminSideUpdateQuotationJob($request_quotation, $mergedProducts,$account_manager_email));
        }else{
            dispatch(new AdminSideUpdateQuotationJob($request_quotation, $mergedProducts));
        }
        dispatch(new AdminSideUpdateClientQuotationJob($request_quotation, $mergedProducts));
        return redirect()->route('admin.index.quotation')->with('success', 'Quotation Updated successfully');
    }

    public function deleteAdminQuotation($id)
    {
        // dd($id);
        RequestQuotation::find($id)->delete();
        return redirect()->route('admin.index.quotation')->with('danger', 'Quotation deleted successfully');
    }
}
