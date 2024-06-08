<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\discount;

class discontcouponcontroller extends Controller
{
    public function discount()
    {
        $discount = discount::all();
        return view('admin.Discount_coupon.show_discount')->with('discount', $discount);
    }
    public function create_discount()
    {
        return view('admin.Discount_coupon.create');
    }
    public function add_discount(Request $request)
    {
        $validation = [
            'discount_coupon' => 'required|string|max:255',
            'discount' => 'required|numeric',
            'status' => 'required|in:0,1',
            'is_one_time' => 'nullable|boolean',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'discount_type' => 'required',
        ];

        $validator = Validator::make($request->all(), $validation);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $isOneTime = $request->has('is_one_time') ? $request->is_one_time : 0;
        $discountcoupon = discount::create([
            'discount_coupon' => $request->discount_coupon,
            'discount' =>  $request->discount,
            'status' => $request->status,
            'is_one_time' =>  $isOneTime,
            'start_date' => $request->start_date,
            'end_date' =>  $request->end_date,
            'discount_type' =>  $request->discount_type,
        ]);

        if ($discountcoupon) {
            return redirect()->route('discount')->with('success', 'Discount Added Successfully !');
        }
    }
    public function edit_discount(Request $request)
    {
        $discount = discount::find($request->id);
        if ($discount) {
            return view('admin.Discount_coupon.edit')->with('discount', $discount);
        }
    }
    public function store_discount(Request $request)
    {
        $validation = [
            'discount_coupon' => 'required|string|max:255',
            'discount' => 'required|numeric',
            'status' => 'required|in:0,1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'discount_type' => 'required',
        ];

        $validator = Validator::make($request->all(), $validation);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $discountcoupon = discount::find($request->id);
        if ($discountcoupon) {
            $discountcoupon->update([
                'discount_coupon' => $request->discount_coupon,
                'discount' => $request->discount,
                'status' => $request->status,
                'is_one_time' => $request->is_one_time ?? 0,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'discount_type' => $request->discount_type,
            ]);
            return redirect()->route('discount')->with('success', 'Discount Edit Successfully !');
        }
    }
    public function delete_discount(Request $request)
    {
        $delete_id = $request->id;
        $discountcoupon = discount::find($delete_id);
        $discountcoupon->delete();
        if ($discountcoupon) {
            return redirect()->route('discount')->with('success', 'Discount Deleted Successfully !');
        }
    }
}
