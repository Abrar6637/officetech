<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AccountManager;
use Illuminate\Http\Request;

class AccountManagerController extends Controller
{
    public function show()
    {
        $managers = AccountManager::orderBy('id', 'desc')->get();
        return view('admin.account-manager.index', compact('managers'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required||email',
            'phone' => 'required',
        ]);
            $isDefaultManager = $request->has('default_manager');
            if ($isDefaultManager) {
                AccountManager::where('is_default_manager', true)->update(['is_default_manager' => false]);
            }

        if($validate)
        {
            $store = AccountManager::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => $request->status,
                'is_default_manager' => $isDefaultManager,
            ]);
            if($store)
            {
                return redirect()->route('account.manager')
                ->with('success','Manager Added Successfully');
            }
        }
        else{
            return redirect()->back()->withErrors($request->errors())->withInput();
        }
    }
    public function edit($id)
    {
        $manager = AccountManager::findOrFail($id);
        return view('admin.account-manager.edit', compact('manager'));
    }
    public function update(Request $request,$id)
    {
        
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required||email',
            'phone' => 'required',
        ]);
        $isDefaultManager = $request->has('default_manager');
        if ($isDefaultManager) {
            AccountManager::where('is_default_manager', true)->update(['is_default_manager' => false]);
        }
        if($validate)
        {
            $manager = AccountManager::findOrFail($id);
            $update = $manager->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => $request->status,
                'is_default_manager' => $isDefaultManager,
                
            ]);
            if($update)
            {
                return redirect()->route('account.manager')
                ->with('success','Manager Updated Successfully');
            }
        }
        else{
            return redirect()->back()->withErrors($request->errors())->withInput();
        }
    }
    public function destroy($id)
    {
        $manager = AccountManager::findOrFail($id);
        $manager->delete();
        return redirect()->route('account.manager')->with('success','Manager Deleted Successfully');
    }
}

