<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\serviceProduct;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\admin\Services;
use Illuminate\Http\Request;

class service_product extends Controller
{
    public function create_services()
    {
        $Services = Services::where('status', '1')->get();
        return view('admin.Services_product.create', compact('Services'));
    }
    public function show_services()
    {
        $Services = serviceProduct::all();
        return view('admin.Services_product.show', compact('Services'));
    }
    public function add_services(Request $request)
    {

        $rules = [
            'service_sku' => 'required',
            'title' => 'required',
            'status' => 'required',
            'service_id' => 'required',
            'price' => 'required|numeric|between:-2147483648,2147483647',
            'image_url.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if ($request->hasFile('image_url') && $request->file('image_url')->isValid()) {
            $image_name = time() . '.' . $request->file('image_url')->extension();
            $request->file('image_url')->move(public_path('assets/images/services'), $image_name);
        } else {
            $image_name = 0;
        }

        $slug = Str::slug($request->title);
        $products = serviceProduct::create([
            'service_sku' => $request->service_sku,
            'title' =>  $request->title,
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'service_id' => $request->service_id,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'image_url' => $image_name,
            'meta_title' => $request->meta_title ?? '',
            'meta_description' => $request->meta_description ?? '',
            'slug' => $slug,
        ]);
        return redirect()->route('show.product.services');
    }
    public function edit_services($id)
    {
        $Services = Services::where('status', '1')->get();
        $product_Service = serviceProduct::find($id);
        return view('admin.Services_product.edit', compact('product_Service', 'Services', 'id'));
    }

    public function update_services(Request $request)
    {
        $rules = [
            'service_sku' => 'required',
            'title' => 'required',
            'status' => 'required',
            'service_id' => 'required',
            'price' => 'required|numeric|between:-2147483648,2147483647',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $productService = serviceProduct::find($request->id);
        if ($request->hasFile('image_url')) {
            foreach ($request->file('image_url') as $file) {
                if ($file->isValid()) {
                    if ($productService->image_url) {
                        unlink(public_path('assets/images/services') . '/' . $productService->image_url);
                    }
                    $image_name = time() . '.' . $file->extension();
                    $file->move(public_path('assets/images/services'), $image_name);
                    $productService->image_url = $image_name;
                }
            }
        }

        $slug = Str::slug($request->title);
        $productService->update([
            'service_sku' => $request->service_sku,
            'title' => $request->title,
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'service_id' => $request->service_id,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'meta_title' => $request->meta_title ?? '',
            'meta_description' => $request->meta_description ?? '',
            'slug' => $slug,
        ]);
        return redirect()->route('show.product.services');
    }
    public function delete_services($id)
    {
        $Services = serviceProduct::findOrFail($id);
        if ($Services) {
            $Services->delete();
            return redirect()->route('show.product.services')->with('success', 'Services Deleted successfully');
        }
    }
}
