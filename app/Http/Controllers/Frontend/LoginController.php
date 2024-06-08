<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function sign_up(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);

        if ($validator->fails()) {
            Session::flash('error_message', '1');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'address' => $request->input('address'),
        ]);

        return view('frontend.user.sign-in');
    }

    protected function sign_up_ajax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        
        if($user){
            if (Hash::check($request->password, $user->password)) {
                $without_user_add_to_Cart = Session::get('without_user_add_to_Cart');
                Cart::where('user_id', $without_user_add_to_Cart)->update(['user_id' => $user->id]);
                Session::forget('without_user_add_to_Cart');
                Session::put('user_authenticated', true);
                Session::put('user_id', $user->id);
                Session::put('user_name', $user->name);
                Session::put('user_email', $user->email);
            }
        }
        return response()->json(['status' => 'success', 'message'=> 'Data Received Successfully']);
    }

    protected function sign_in(Request $request)
    {
        $email = $request->email;
        $user = DB::table('users')->where('email', $email)->first();
        if ($user) {

            if (Hash::check($request->password, $user->password)) {
                Session::put('user_authenticated', true);
                Session::put('user_id', $user->id);
                Session::put('user_name', $user->name);
                Session::put('user_email', $user->email);
                return redirect()->route('user.index');
            } else {
                return redirect()->back()->with('error', 'Invalid Email or Password');
            }
        } else {
            return redirect()->back()->with('error', 'User Does not Exist');
        }
    }

    protected function sign_in_ajax(Request $request)
    {
        $email = $request->email;
        $user = DB::table('users')->where('email', $email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $without_user_add_to_Cart = Session::get('without_user_add_to_Cart');
                Cart::where('user_id', $without_user_add_to_Cart)->update(['user_id' => $user->id]);
                Session::forget('without_user_add_to_Cart');
                Session::put('user_authenticated', true);
                Session::put('user_id', $user->id);
                Session::put('user_name', $user->name);
                Session::put('user_email', $user->email);
                return response()->json(['status' => 'success', 'message'=> 'Data Received Successfully']);
            } else {
                return response()->json(['error' => 'Invalid Email or Password'], 422);
            }
        } else {
            return response()->json(['error' => 'User Does not Exist'], 422);
        }
    }
}
