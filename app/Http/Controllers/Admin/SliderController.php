<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Slider;
use App\Models\Product;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends Controller
{

    public function show()
    {
        $sliders = Slider::all();
        return view('admin.Slider.slider', compact('sliders'));
    }
    public function add()
    {

        return view('admin.Slider.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required',
            'product_sku' => 'required',
            'prints' => 'required',
            'contract_years' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
        ]);

        if ($data) {

            if ($request->hasFile('image')) {
                $originalName = $request->file('image')->getClientOriginalName();
                $imageName = $originalName;
                $request->file('image')->move(public_path('images/SliderImages'), $imageName);
                $sku = $request->product_sku;
                $product = Product::where('sku', $sku)->first();
                if ($product) {
                    $product_slug = $product->slug;
                } else {
                    return redirect()->route('add.slider')->with('error', 'SKU does not exist.')->withInput();
                }

                $slider = Slider::create([
                    'description' => $data['description'],
                    'sku' => $data['product_sku'],
                    'prints' => $data['prints'],
                    'contract_years' => $data['contract_years'],
                    'product_slug' => $product_slug,
                    'image' => $imageName,
                    'status' => $data['status']
                ]);

                if ($slider) {
                    return redirect()->route('admin.slider')->with('success', 'Slider Added Successfuly');
                }
            }
        } else {
            return redirect()->route('add.slider')->with('error', 'Error adding Slider.')->withInput();
        }
    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('admin.Slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'description' => 'required',
            'product_sku' => 'required',
            'prints' => 'required',
            'contract_years' => 'required',
            'status' => 'required',
        ]);
    
        $slider = Slider::find($id);
        $sku = $request->product_sku;
        $product = Product::where('sku', $sku)->first();
    
        if ($product) {
            $product_slug = $product->slug;
        } else {
            return redirect()->route('add.slider')->with('error', 'SKU does not exist.')->withInput();
        }
        if ($data) {
            if ($request->hasFile('image')) {
                $image_validate = $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
                ]);
    
                if ($image_validate) {
                    if ($slider->image) {
                        $imagePath = public_path('images/' . $slider->image);
                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }
                    $originalName = $request->file('image')->getClientOriginalName();
                    $imageName = $originalName;
                    $request->file('image')->move(public_path('images/SliderImages'), $imageName);
                    $slider->update([
                        'description' => $data['description'],
                        'sku' => $sku,
                        'prints' => $data['prints'],
                        'contract_years' => $data['contract_years'],
                        'status' => $data['status'],
                        'product_slug' => $product_slug,
                        'image' => $imageName,
                    ]);
    
                    return redirect()->route('admin.slider')->with('success', 'Slider Edited Successfully');
                } else {
                    return redirect()->route('add.slider')->with('error', 'Error Updating Slider.')->withInput();
                }
            } else {
                // Update slider without changing the image
                $slider->update([
                    'description' => $data['description'],
                    'sku' => $data['product_sku'],
                    'prints' => $data['prints'],
                    'contract_years' => $data['contract_years'],
                    'status' => $data['status'],
                    'product_slug' => $product_slug,
                ]);
    
                return redirect()->route('admin.slider')->with('success', 'Slider Edited Successfully');
            }
        } else {
            return redirect()->route('add.slider')->with('error', 'Error updating Slider.')->withInput();
        }
    }
    
    public function destory($id)
    {
        $slider = Slider::find($id);
        $delete = $slider->delete();
        if($delete)
        {
            return redirect()->route('admin.slider')->with('success', 'Slider Deleted Successfuly');
        }
    }
}
