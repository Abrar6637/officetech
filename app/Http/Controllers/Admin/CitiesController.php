<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Cities;
use App\Models\Admin\Region;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function show()
    {
        $regions = Region::where('status','1')->get();
        $cities = Cities::all();
        return view('admin.cities.index',compact('regions','cities'));
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
        ]);
        if($validate)
        {
            $store = Cities::create([
                'name' => $request->name,
                'region_id' => $request->region,
                'status' => $request->status,
            ]);
            if($store)
            {
                return redirect()->route('cities')
                ->with('success','City Added Successfully');
            }
        }
        else{
            return redirect()->back()->withErrors($request->errors())->withInput();
        }
    }
    public function edit($id)
    {
        $regions = Region::where('status','1')->get();
        $city = Cities::findOrFail($id);
        return view('admin.cities.edit', compact('city','regions'));
    }
    public function update(Request $request,$id)
    {
        
        $validate = $request->validate([
            'name' => 'required',
        ]);
        if($validate)
        {
            $city = Cities::findOrFail($id);
            $update = $city->update([
                'name' => $request->name,
                'region_id' => $request->region,
                'status' => $request->status,
                
            ]);
            if($update)
            {
                return redirect()->route('cities')
                ->with('success','City Updated Successfully');
            }
        }
        else{
            return redirect()->back()->withErrors($request->errors())->withInput();
        }
    }
    public function destroy($id)
    {
        $city = Cities::findOrFail($id);
        $city->delete();
        return redirect()->route('cities')->with('success','City Deleted Successfully');
    }
}
