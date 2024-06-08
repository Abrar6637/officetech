<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AccountManager;
use App\Models\Admin\Country;
use App\Models\Admin\Region;
use App\Models\customer_order;
use App\Models\User;
use App\Models\UserBillingDetails;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show()
    {
        $users = User::all();
        $user_details = [];
        if ($users->isNotEmpty()) {
            $userIds = $users->pluck('id')->toArray();
            foreach ($userIds as $userId) {
                $billingDetail = UserBillingDetails::where('user_id', $userId)->first();
                $customerOrder = customer_order::where('user_id', $userId)->first();
                $user_details[$userId] = [
                    'billing_detail' => $billingDetail,
                    'customer_order' => $customerOrder
                ];
            }
        }
        return view('admin.Users.index', compact('users', 'user_details'));
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $countries = Country::where("status",'1')->get();
        $regions = Region::where("status",'1')->get();
        $accountManagers = AccountManager::where("status",'1')->get();
        $customer_details = [];
        $billingDetail = UserBillingDetails::where('user_id', $user->id)->first();
        $customerOrder = customer_order::where('user_id', $user->id)->first();
        $customer_details['billingDetail'] = $billingDetail;
        $customer_details['customerOrder'] = $customerOrder;
        return view('admin.Users.edit', compact('user', 'customer_details','countries','regions','accountManagers'));
    }
    // public function update(Request $request, $id)
    // {
    //     $validate = $request->validate([
    //         'user_name' => 'required|string|max:255',
    //         'user_email' => 'required|max:255',
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'address' => 'required|string|max:255',
    //         'country' => 'required|string|max:255',
    //         'region' => 'required|string|max:255',
    //         'cr_no' => 'required|string|max:255',
    //         'vat_reg_no' => 'required|numeric',
    //         'billing_email' => 'required|email|max:255',
    //         'phone' => 'required|string|max:20',
    //         'account_manager' => 'required|string|max:255',
    //     ]);
    //     if ($validate) {
    //         $user = User::findOrFail($id);
    //         $updateUser = $user->update([
    //             'name' => $request->user_name,
    //             'email' => $request->user_email,
    //         ]);
    //         if ($updateUser) {
    //             $billingDetails = UserBillingDetails::where('user_id', $id)->first();
    //             if ($billingDetails) {
    //                 $billingDetails->update([
    //                     'first_name' => $request->first_name,
    //                     'last_name' => $request->last_name,
    //                     'address' => $request->address,
    //                     'country' => $request->country,
    //                     'region' => $request->region,
    //                     'cr_no' => $request->cr_no,
    //                     'vat_reg_no' => $request->vat_reg_no,
    //                     'email' => $request->billing_email,
    //                     'phone_number' => $request->phone,
    //                     'account_manager' => $request->account_manager,
    //                 ]);
    //             } else {
    //                 $customerOrder = customer_order::where('user_id', $id)->first();
    //                 if ($customerOrder) {
    //                     $customerOrder->update([
    //                         'first_name' => $request->first_name,
    //                         'last_name' => $request->last_name,
    //                         'address' => $request->address,
    //                         'country' => $request->country,
    //                         'region_state' => $request->region,
    //                         'company_reg_no' => $request->cr_no,
    //                         'vat_reg_no' => $request->vat_reg_no,
    //                         'email' => $request->billing_email,
    //                         'phone_number' => $request->phone,
    //                         'account_manager' => $request->account_manager,
    //                     ]);
    //                 } else {
    //                     UserBillingDetails::create([
    //                         'user_id' => $id,
    //                         'first_name' => $request->first_name,
    //                         'last_name' => $request->last_name,
    //                         'address' => $request->address,
    //                         'country' => $request->country,
    //                         'region' => $request->region,
    //                         'cr_no' => $request->cr_no,
    //                         'vat_reg_no' => $request->vat_reg_no,
    //                         'email' => $request->billing_email,
    //                         'phone_number' => $request->phone,
    //                         'account_manager' => $request->account_manager,
    //                     ]);
    //                     return redirect()->route('admin.users')->with('success', 'Customer Billing Details Added by admin for ' . $user->name . 'Customer .');

    //                 }
    //             }
    //             return redirect()->route('admin.users')->with('success', 'Customer Details Updated Successfully');
    //         }
    //     }
    // }    
    public function update(Request $request, $id)
{
    $validate = $request->validate([
        'user_name' => 'required|string|max:255',
        'user_email' => 'required|max:255',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'region' => 'required|string|max:255',
        'cr_no' => 'required|string|max:255',
        'vat_reg_no' => 'required|numeric',
        'billing_email' => 'required|email|max:255',
        'phone' => 'required|string|max:20', 
        'account_manager' => 'required|string|max:255',
    ]);

    if ($validate) {
        $user = User::findOrFail($id);
        $updateUser = $user->update([
            'name' => $request->user_name,
            'email' => $request->user_email,
        ]);

        if ($updateUser) {
            $billingDetails = UserBillingDetails::where('user_id', $id)->first();

            if ($billingDetails) {
                $billingDetails->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'address' => $request->address,
                    'country' => $request->country,
                    'region' => $request->region,
                    'cr_no' => $request->cr_no,
                    'vat_reg_no' => $request->vat_reg_no,
                    'email' => $request->billing_email,
                    'phone_number' => $request->phone,
                    'account_manager' => $request->account_manager,
                ]);
            } else {
                $customerOrder = customer_order::where('user_id', $id)->first();

                if ($customerOrder) {
                    $customerOrder->update([
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'address' => $request->address,
                        'country' => $request->country,
                        'region_state' => $request->region,
                        'company_reg_no' => $request->cr_no,
                        'vat_reg_no' => $request->vat_reg_no,
                        'email' => $request->billing_email,
                        'phone_number' => $request->phone,
                        'account_manager' => $request->account_manager,
                    ]);
                } else {
                    UserBillingDetails::create([
                        'user_id' => $id,
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'address' => $request->address,
                        'country' => $request->country,
                        'region' => $request->region,
                        'cr_no' => $request->cr_no,
                        'vat_reg_no' => $request->vat_reg_no,
                        'email' => $request->billing_email,
                        'phone_number' => $request->phone,
                        'account_manager' => $request->account_manager,
                    ]);

                    return redirect()->route('admin.users')->with('success', 'Customer Billing Details Added by admin for ' . $user->name . ' Customer .');
                }
            }
            return redirect()->route('admin.users')->with('success', 'Customer Details Updated Successfully.');
        }
    }
}

}
