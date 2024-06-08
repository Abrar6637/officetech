<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function show()
    {
        $regions = Region::orderBy('id', 'desc')->get();
        return view('admin.Region.index', compact('regions'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'amount' => 'required',
            'shipping_type' => 'required',
            'delivery_days' => 'required'
        ]);

        if($validate)
        {
            $store = Region::create([
                'name' => $request->name,
                'shipping_type' => $request->shipping_type,
                'amount' => $request->amount,
                'delivery_days' => $request->delivery_days,
                'status' => $request->status,
            ]);
            if($store)
            {
                return redirect()->route('region')
                ->with('success','Region Added Successfully');
            }
        }
        else{
            return redirect()->back()->withErrors($request->errors())->withInput();
        }
    }
    public function edit($id)
    {
        $region = Region::findOrFail($id);
        return view('admin.Region.edit', compact('region'));
    }
    public function update(Request $request,$id)
    {
        $validate = $request->validate([
            'name' => 'required',
            'amount' => 'required',
            'delivery_days' => 'required',
            'shipping_type' => 'required'
        ]);
        if($validate)
        {
            $region = Region::findOrFail($id);
            $update = $region->update([
                'name' => $request->name,
                'amount' => $request->amount,
                'shipping_type' => $request->shipping_type,
                'delivery_days' => $request->delivery_days,
                'status' => $request->status,
            ]);
            if($update)
            {
                return redirect()->route('region')
                ->with('success','Region Updated Successfully');
            }
        }
        else{
            return redirect()->back()->withErrors($request->errors())->withInput();
        }
    }
    public function destroy($id)
    {
        $region = Region::findOrFail($id);
        $region->delete();
        return redirect()->route('region')->with('success','Region Deleted Successfully');
    }
}
