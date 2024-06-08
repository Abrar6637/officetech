<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;


class GuestUserController extends Controller
{
    public function index()
    {
        $guest_users = DB::table('guest_user')->get(); 
        return view('admin.Guest_users.index', compact('guest_users'));
    }
    public function create()
    {
        return view('admin.Guest_users.add');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_email' => 'required|email|unique:guest_user,email',
            'password' => 'required|min:4|confirmed',
            'status' => 'required|in:0,1', 
        ]);
    
        $user = [
            'email' => $validatedData['user_email'],
            'password' => bcrypt($validatedData['password']),
            'status' => $validatedData['status'], 
        ];
    
        DB::table('guest_user')->insert($user);
    
        return redirect()->route('user.guest-user.index')->with('success', 'Guest User created successfully!');
    }

    public function edit($id)
    {
        $guest_user = DB::table('guest_user')->find($id);
        if (!$guest_user) {
            return Redirect::back()->with('error', 'Guest user not found!');
        }
        return view('admin.Guest_users.edit', compact('guest_user'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_email' => 'required|email|unique:guest_user,email,'.$id,
            'password' => 'nullable|min:4|confirmed',
            'status' => 'required|in:0,1',
        ]);
    
        $guest = [
            'email' => $validatedData['user_email'],
            'status' => $validatedData['status'],
        ];
    
        if ($request->filled('password')) {
            $currentPassword = DB::table('guest_user')->where('id', $id)->value('password');
            if (Hash::check($request->input('current_password'), $currentPassword)) {
                dd("2323");
                return redirect()->back()->with('error', 'Current password is incorrect.');
            }
            $guest['password'] = bcrypt($validatedData['password']);
        }
    
        DB::table('guest_user')
            ->where('id', $id)
            ->update($guest);
    
        return redirect()->route('user.guest-user.index')->with('success', 'Guest User updated successfully!');
    }
    
    public function destroy($id)
    {
        DB::table('guest_user')->where('id', $id)->delete();
        return redirect()->route('user.guest-user.index')->with('success', 'Guest User deleted successfully!');
    }
}
