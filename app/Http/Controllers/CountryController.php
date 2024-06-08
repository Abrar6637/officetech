<?php

namespace App\Http\Controllers;

use App\Models\Admin\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function show()
    {
        $countries = Country::all();
        return view('admin.country.index',compact('countries'));
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
        ]);
        $isDefaultCountry = $request->has('default_country');
        if ($isDefaultCountry) {
            Country::where('is_default_country', true)->update(['is_default_country' => false]);
        }
        if($validate)
        {
            $store = Country::create([
                'name' => $request->name,
                'is_default_country' => $isDefaultCountry,
                'status' => $request->status,
            ]);
            if($store)
            {
                return redirect()->route('countries')
                ->with('success','Country Added Successfully');
            }
        }
        else{
            return redirect()->back()->withErrors($request->errors())->withInput();
        }
    }
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('admin.country.edit', compact('country'));
    }
    public function update(Request $request,$id)
    {
        
        $validate = $request->validate([
            'name' => 'required',
        ]);
        $isDefaultCountry = $request->has('default_country');
        if ($isDefaultCountry) {
            Country::where('is_default_country', true)->update(['is_default_country' => false]);
        }
        if($validate)
        {
            $country = Country::findOrFail($id);
            $update = $country->update([
                'name' => $request->name,
                'is_default_country' => $isDefaultCountry,
                'status' => $request->status,
                
            ]);
            if($update)
            {
                return redirect()->route('countries')
                ->with('success','Country Updated Successfully');
            }
        }
        else{
            return redirect()->back()->withErrors($request->errors())->withInput();
        }
    }
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();
        return redirect()->route('countries')->with('success','Country Deleted Successfully');
    }
}
