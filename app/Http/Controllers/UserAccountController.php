<?php

namespace App\Http\Controllers;

use App\Models\customer_order;
use App\Models\User;
use App\Models\UserAccountDetails;
use App\Models\UserBillingDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserAccountController extends Controller
{
    //
    public function storeAccountDetails(Request $request)
    {
        $rules = [
            'display_name' => 'required',
            'full_name' => 'required',
            'user_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // $user_id = (int) Session::get('user_id');
        $sessions = session()->all();
        $user_id = session('user_id');
        // dd($user_id);
        

        $userAccountDetails = UserAccountDetails::where('user_id', $user_id)->first();
        // dd($userAccountDetails);
        if ($userAccountDetails) {
            $userAccountDetails->update([
                'display_name' => $request->display_name,
                'full_name' => $request->full_name,
                'user_name' => $request->user_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'user_id' => $user_id,
            ]);
        } else {
            UserAccountDetails::create([
                'display_name' => $request->display_name,
                'full_name' => $request->full_name,
                'user_name' => $request->user_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'user_id' => $user_id,
            ]);
        }

        return redirect()->route('user.user_setting')->with('success', 'User Account Details updated successfully');
    }

    public function storeBillingDetails(Request $request)
    {
        // dd($request->all());
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'country' => 'required',
            'region' => 'required',
            'cr_no' => 'required',
            'vat_reg_no' => 'required',
            'billing_email' => 'required|email',
            'billing_phone_number' => 'required|numeric',
            'account_manager' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // dd('failed');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            // dd('else');
            $user_id = Session::get('user_id');
            $userBillingDetails = UserBillingDetails::where('user_id', $user_id)->first();
            if ($userBillingDetails) {
                
                $userBillingDetails ->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'company_name' => $request->company_name ?? '',
                    'address' => $request->address,
                    'country' => $request->country,
                    'region' => $request->region,
                    'cr_no' => $request->cr_no,
                    'vat_reg_no' => $request->vat_reg_no,
                    'email' => $request->billing_email,
                    'phone_number' => $request->billing_phone_number,
                    'account_manager' => $request->account_manager,
                    'user_id' => $user_id,
                ]);
            } else {
                UserBillingDetails::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'company_name' => $request->company_name ?? '',
                    'address' => $request->address,
                    'country' => $request->country,
                    'region' => $request->region,
                    'cr_no' => $request->cr_no,
                    'vat_reg_no' => $request->vat_reg_no,
                    'email' => $request->billing_email,
                    'phone_number' => $request->billing_phone_number,
                    'account_manager' => $request->account_manager,
                    'user_id' => $user_id,
                ]);
            }
            return redirect()->route('user.user_setting')->with('success', 'User Billing Details updated successfully');
        }
    }
    public function changePassword(Request $request,$id)
    {
        $validate = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
        if($validate)
        {
            $user = User::findOrFail($id);
            if (Hash::check($request->current_password, $user->password)) {
                if($request->new_password == $request->confirm_password)
                {
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    return redirect()->back()->with('success', 'Password changed successfully');
                }
                else
                {
                    return redirect()->back()->with('error', 'New password and confirm password does not match');
                }
            }
            else
            {
                return redirect()->back()->with('error', 'Current password is incorrect');
            }
        }
        else
        {
            return redirect()->back()->withErrors($validate)->withInput();
        }
    }
}
