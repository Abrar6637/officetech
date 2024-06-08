<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\addCategories;
use App\Models\categories;
use App\Models\sub_main_category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use App\Models\product_attribute;
use App\Models\product_gallery_images;
use App\Models\brands;
use App\Models\product_item_code;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    protected $main_categories;
    protected $subCategories;
    public $user_id;
    public $withoutUserCookie;

    public function __construct()
    {
          $this->main_categories = addCategories::where('status', 1)
        ->orderBy('category_order')
        ->get();
        $this->subCategories = sub_main_category::where('status', 1)->get();
        view()->share('main_categories', $this->main_categories);
        view()->share('sub_categories', $this->subCategories);
    }

    public function allproduct()
    {
        $Product = Product::all();
        return view('admin/products/showproduct')->with('Product', $Product);
    }

    public function showproduct()
    {
        $subCategories = sub_main_category::all();
        $categories = categories::all();
        $ProductTypes = ProductTypes::all();
        $main_categories = addCategories::all();
        $brand = brands::all();
        return view('admin/products/addproducts')->with('main_categories', $main_categories)
            ->with('subCategories', $subCategories)->with('sub_sub_categories', $categories)
            ->with('ProductTypes', $ProductTypes)->with('brand', $brand);
    }

    public function storeproduct(Request $request)
    {

        $rules = [
            'sku' => 'required',
            'name' => 'required',
            'status' => 'required',
            'model_number' => 'required',
            'brand_id' => 'required',
            'availability' => 'required',
            'quantity' => 'required|numeric|between:-2147483648,2147483647',
            'min_quantity' => 'required|numeric|between:-2147483648,2147483647',
            'price' => 'required|numeric|between:-2147483648,2147483647',
            'product_type_id' => 'required',
            'galleryimages.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
        ];

        $messages = [
            'quantity.between' => 'The quantity must be within the allowed range.',
            'price.between' => 'The price must be within the allowed range.',
            'quantity.numeric' => 'The quantity must be a number.',
            'min_quantity.numeric' => 'The Minimum quantity must be a number.',
            'price.numeric' => 'The price must be a number.',
            'galleryimages.*.required' => 'All gallery images are required.',
            'galleryimages.*.image' => 'All Product images must be image files (JPEG, PNG, JPG, GIF).',
            'galleryimages.*.mimes' => 'All Product images must be in one of the following formats: JPEG, PNG, JPG, GIF.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $slug = Str::slug($request->name);
        $products = Product::create([
            'sku' => $request->sku,
            'license' =>  $request->license,
            'name' => $request->name,
            'status' => $request->status,
            'model_number' => $request->model_number,
            'warrenty' => $request->warrenty,
            'brand_id' => $request->brand_id,
            'categories_id' => $request->category,
            'sub_categories_id' => $request->sub_category,
            'sub_sub_categories_id' => $request->sub_sub_category,
            'product_description' => $request->product_description,
            'availability' => $request->availability,
            'quantity' => $request->quantity,
            'min_qty' => $request->min_quantity,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'specifications' => $request->specifications,
            'product_type_id' => $request->product_type_id,
            'featured_product' => $request->is_featured,
            'recommended' => $request->is_recommended,
            'meta_title' => $request->product_meta_title ?? '',
            'slug' => $slug,
            'meta_description' => $request->product_meta_description ?? '',
        ]);

        $product_id = Product::orderBy('id', 'desc')->first();
        $product_id = $product_id->id;

        $product_attribute = product_attribute::create([
            'functional' => $request->functional,
            'type' => $request->type,
            'speed' => $request->speed,
            'compatible_toners' => $request->compatible_toners,
            'yeild' => $request->yeild,
            'product_id' => $product_id,
            'bundles' => $request->bundles,
            'paper_size' => $request->paper_size ?? '',
        ]);

        if ($request->has('product_code') && $request->product_code[0] != null && !empty($request->product_code[0])) {
            foreach ($request->product_code as $product_codes) {
                product_item_code::create([
                    'product_code' => $product_codes,
                    'product_id' => $product_id,
                ]);
            }
        }

        if ($request->hasFile('galleryimages')) {
            foreach ($request->file('galleryimages') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/product_images'), $imageName);

                product_gallery_images::create([
                    'images' => $imageName,
                    'product_id' => $product_id,
                ]);
            }
        }

        if ($product_attribute && $products) {
            return redirect()->route('products')->with('success', 'Products Added Successfully !');
        }
    }
    public function getSubCategories($category)
    {
        $subCategories = sub_main_category::where('parent_category_id', $category)->get();
        $subCategoryOptions = '';
        foreach ($subCategories as $category) {
            $subCategoryOptions .= "<option value='{$category->id}'>{$category->sub_category_name}</option>";
        }
        return response()->json(['options' => $subCategoryOptions]);
    }

    public function getSubSubCategories($subcategory)
    {
        $subSubCategories  = categories::where('sub_category_id', $subcategory)->get();
        $subSubCategoryOptions = '';
        foreach ($subSubCategories as $category) {
            $subSubCategoryOptions .= "<option value='{$category->id}'>{$category->sub_category_name}</option>";
        }
        return response()->json(['options' => $subSubCategoryOptions]);
    }


    public function delete_products($id)
    {
        $products = Product::find($id);
        if ($products) {
            $product_gallery_images = product_gallery_images::where('product_id', $id)->get();
            $product_attribute = product_attribute::where('product_id', $id)->get();
            $product_item_code = product_item_code::where('product_id', $id)->get();
            foreach ($product_gallery_images as $image) {
                $image->delete();
            }
            foreach ($product_attribute as $product_attributee) {
                $product_attributee->delete();
            }
            foreach ($product_item_code as $product_item_codes) {
                $product_item_codes->delete();
            }
            $products->delete();
            return redirect()->route('products')->with('success', 'Product deleted successfully');
        }
    }

    public function edit_products($id)
    {
        $categories = categories::all();
        $ProductTypes = ProductTypes::all();
        $main_categories = addCategories::all();
        $products = Product::find($id);
        $subCategories = sub_main_category::where('parent_category_id', $products->categories_id)->get();
        $brand = brands::all();
        if ($products) {
            return view('admin/products/editproduct')->with('main_categories', $main_categories)
                ->with('subCategories', $subCategories)->with('sub_sub_categories', $categories)
                ->with('ProductTypes', $ProductTypes)->with('products', $products)->with('brand', $brand);
        }
    }

    public function update_products(Request $request, $id)
    {
        $rules = [
            'sku' => 'required',
            'name' => 'required',
            'status' => 'required',
            'model_number' => 'required',
            'availability' => 'required',
            'quantity' => 'required|numeric',
            'min_quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'galleryimages.*' => 'required|image|mimes:jpeg,png,jpg,gif',
        ];

        $messages = [
            'quantity.numeric' => 'The quantity must be a number.',
            'min_quantity.numeric' => 'The Minimum quantity must be a number.',
            'price.numeric' => 'The price must be a number.',
            'galleryimages.*.required' => 'All gallery images are required.',
            'galleryimages.*.image' => 'All Product images must be image files (JPEG, PNG, JPG, GIF).',
            'galleryimages.*.mimes' => 'All Product images must be in one of the following formats: JPEG, PNG, JPG, GIF.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $product = Product::find($id);

        $slug = Str::slug($request->name);
        $product->update([
            'sku' => $request->sku,
            'license' => $request->license,
            'name' => $request->name,
            'status' => $request->status,
            'model_number' => $request->model_number,
            'warrenty' => $request->warrenty,
            'brand_id' => $request->brand_id,
            'categories_id' => $request->category,
            'sub_categories_id' => $request->sub_category,
            'sub_sub_categories_id' => $request->sub_sub_category,
            'product_description' => $request->product_description,
            'availability' => $request->availability,
            'quantity' => $request->quantity,
            'min_qty' => $request->min_quantity,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'specifications' => $request->specifications,
            'featured_product' => $request->is_featured,
            'meta_title' => $request->product_meta_title,
            'recommended' => $request->is_recommended,
            'meta_description' => $request->product_meta_description,
        ]);

        $product->update(['slug' => $slug]);

        $productAttribute = product_attribute::where('product_id', $id)->first();
        $productAttribute->update([
            'functional' => $request->functional,
            'type' => $request->type,
            'speed' => $request->speed,
            'compatible_toners' => $request->compatible_toners,
            'yeild' => $request->yeild,
            'bundles' => $request->bundles,
            'paper_size' => $request->paper_size,
        ]);

        $product_item_code = product_item_code::where('product_id', $id)->get();
        if ($request->has('product_code') && $request->product_code[0] != null && !empty($request->product_code[0])) {
            foreach ($product_item_code as $product_item_codes) {
                $product_item_codes->delete();
            }
            foreach ($request->product_code as $product_codes) {
                product_item_code::create([
                    'product_code' => $product_codes,
                    'product_id' => $id
                ]);
            }
        }

        $productgallery = product_gallery_images::where('product_id', $id)->get();
        if ($request->hasFile('galleryimages')) {
            // foreach ($productgallery as $image) {
            //     $image->delete();
            // }
            foreach ($request->file('galleryimages') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/product_images'), $imageName);
                product_gallery_images::create([
                    'images' => $imageName,
                    'product_id' => $id
                ]);
            }
        }

        if ($product) {
            return redirect()->route('products')->with('success', 'Products Edit Successfully !');
        }
    }
    public function destory_delete_image(Request $request){
        $imageId = $request->input('image_id');
        $image = product_gallery_images::find($imageId);
        if (!$image) {
            return response()->json(['success' => false, 'message' => 'Image not found.']);
        }
        $imagePath = public_path('images/product_images/' . $image->images);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $image->delete();
        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }

    public function show_products_type()
    {
        $products_type = ProductTypes::all();
        return view('products_type')->with('products_type', $products_type);
    }

    public function add_products_type(Request $request)
    {
        $data = $request->validate([
            'products_type' => 'required|string|max:255',
        ]);

        $products_type = ProductTypes::create([
            'product_type' => $data['products_type']
        ]);
        if ($products_type) {
            return redirect()->route('produts.type')->with('success', 'Products Type Added Successfully !');
        }
    }


    public function edit_products_type($id)
    {
        $products_type = ProductTypes::find($id);
        if ($products_type) {
            return view('edit_products_type', compact('products_type'));
        }
    }


    public function update_products_type(Request $request, $id)
    {
        $data = $request->validate([
            'products_type' => 'required|string|max:255',
        ]);
        $products_type = ProductTypes::find($id);
        $products_type->update([
            'product_type' => $data['products_type'],
        ]);
        return redirect()->route('produts.type')->with('success', 'Product Type updated successfully');
    }


    public function delete_products_type($id)
    {
        $products_type = ProductTypes::find($id);
        if ($products_type) {
            $products_type->delete();

            return redirect()->route('produts.type')->with('success', 'Product Type deleted successfully');
        }
    }

    // Add Brands

    public function showBrands()
    {
        $products_type = ProductTypes::all();
        $brands = brands::all();
        return view('admin.products.brands')
            ->with('products_type', $products_type)->with('brands', $brands);
    }

    public function addProductBrand(Request $request)
    {
        $data = $request->validate([
            'brand_name' => 'required|string|max:255',
            'product_type_id' => 'required|exists:product_types,id',
            'brand_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
        ]);
        if ($data) {
            $slug = Str::slug($request->brand_name, '-');
            if ($request->file('brand_image')) {
                $imageName = Str::slug($request->brand_name) . '.' . $request->file('brand_image')->getClientOriginalExtension();
                $image = $request->file('brand_image')->storeAs('brandImages', $imageName, 'public_images');
            }
            $brands = brands::create([
                'product_type_id' => $data['product_type_id'],
                'brand_name' => $data['brand_name'],
                'image' => $image,
                'slug' => $slug,
            ]);

            return redirect()->route('brands')->with('success', 'Brand added successfully');
        } else {
            return redirect()->route('brands')->with('error', 'Error adding brand.')->withInput();
        }
    }
    public function editProductBrand($id)
    {
        $products_type = ProductTypes::all();
        $brands = brands::find($id);
        return view('admin.products.editbrand')
            ->with('brands', $brands)
            ->with('products_type', $products_type);
    }

    public function updateProductBrand(Request $request, $id)
    {
        $data = $request->validate([
            'product_type' => 'required',
            'brand_name' => 'required',
        ]);

        $brand = brands::findOrFail($id);
        $slug = Str::slug($request->brand_name, '-');
        if ($request->hasFile('brand_image')) {
            $request->validate([
                'brand_image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
            ]);
            $imageName = Str::slug($request->brand_name) . '.' . $request->file('brand_image')->getClientOriginalExtension();
            $image = $request->file('brand_image')->storeAs('brandImages', $imageName, 'public_images');
            $brand->update([
                'brand_name' => $data['brand_name'],
                'product_type_id' => $data['product_type'],
                'image' => $image,
                'slug' => $slug,
            ]);
        } else {
            $brand->update([
                'brand_name' => $data['brand_name'],
                'product_type_id' => $data['product_type'],
                'slug' => $slug,
            ]);
        }

        return redirect()->route('brands')->with('success', 'Brand Updated successfully');
    }
    public function deleteProductBrand($id)
    {
        $brand = brands::findOrFail($id);
        if ($brand) {
            $brand->delete();
            return redirect()->route('brands')->with('success', 'Brand Deleted successfully');
        }
    }

    public function showSubCategoryProducts(Request $request, $slug)
    {
        $sub_category = sub_main_category::where('slug', $slug)->first();
        $sub_category_id = $sub_category->id;
        $showProducts = Product::where("status",'1')->where('sub_categories_id',$sub_category_id)->paginate(9);
        $allProducts = Product::with('brand', 'product_attribute')->where('status', '1')->get();
        $brandCounts = [];
        $paperSizeCounts = [];
        $speedCounts = [];
        foreach ($allProducts as $product) {
            $brandName = $product->brand->brand_name;
            if (!isset($brandCounts[$brandName])) {
                $brandCounts[$brandName] = 0;
            }
            $brandCounts[$brandName]++;
        }
        foreach ($allProducts as $product) {
            foreach ($product->product_attribute as $attribute) {
                $paperSize = $attribute->paper_size;

                if (!isset($paperSizeCounts[$paperSize])) {
                    $paperSizeCounts[$paperSize] = 0;
                }

                $paperSizeCounts[$paperSize]++;
            }
        }
        foreach ($allProducts as $product) {
            foreach ($product->product_attribute as $attribute) {
                $speed = $attribute->speed;

                if (!isset($speedCounts[$speed])) {
                    $speedCounts[$speed] = 0;
                }

                $speedCounts[$speed]++;
            }
        }
        return view('frontend.user.printers')
            ->with('brandCounts', $brandCounts)
            ->with('paperSizeCounts', $paperSizeCounts)
            ->with('speedCounts', $speedCounts)
            ->with('showProducts', $showProducts)
            ->with('sub_category', $sub_category);
    }
    public function brands_products(Request $request, $slug)
    {
        $brand = brands::where('slug', $slug)->first();
        $brand_id = $brand->id;
        $showProducts = Product::where('brand_id', $brand_id)->where("status", '1')->paginate(9);
        $allProducts = Product::with('brand', 'product_attribute')->where('status', '1')->get();
        $brandCounts = [];
        $paperSizeCounts = [];
        $speedCounts = [];
        foreach ($allProducts as $product) {
            $brandName = $product->brand->brand_name;
            if (!isset($brandCounts[$brandName])) {
                $brandCounts[$brandName] = 0;
            }
            $brandCounts[$brandName]++;
        }
        foreach ($allProducts as $product) {
            foreach ($product->product_attribute as $attribute) {
                $paperSize = $attribute->paper_size;

                if (!isset($paperSizeCounts[$paperSize])) {
                    $paperSizeCounts[$paperSize] = 0;
                }

                $paperSizeCounts[$paperSize]++;
            }
        }
        foreach ($allProducts as $product) {
            foreach ($product->product_attribute as $attribute) {
                $speed = $attribute->speed;

                if (!isset($speedCounts[$speed])) {
                    $speedCounts[$speed] = 0;
                }

                $speedCounts[$speed]++;
            }
        }
        // $showProducts = $query->where('brand_id', $brand_id)->where("status",'1')->paginate(9);
        return view('frontend.user.brand_products')
        ->with('brandCounts', $brandCounts)
        ->with('brand', $brand)
        ->with('paperSizeCounts', $paperSizeCounts)
        ->with('speedCounts', $speedCounts)
        ->with('showProducts', $showProducts);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $request->session()->put('search_query', $query);
        if ($query == 0) {
            $products = '';
            $galleryImages = '';
            return response()->json(['products' => $products, 'gallery_image' => $galleryImages]);
        }
        $products = Product::where('status', '1')
        ->where(function($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', "%$query%")
                         ->orWhere('sku', 'like', "%$query%")
                         ->orWhere('specifications', 'like', "%$query%")
                         ->orWhere('product_description', 'like', "%$query%");
        })->get();   
        $productIds = $products->pluck('id');
        $galleryImages = [];
        foreach ($productIds as $productId) {
            $firstImage = product_gallery_images::where('product_id', $productId)
                ->pluck('images')
                ->first();

            $galleryImages[] = $firstImage;
        }
        return response()->json(['product' => $products, 'gallery_image' => $galleryImages]);
    }

    public function searchProducts(Request $request)
    {
        $searchQuery = session('search_query');
    
        $showProducts = Product::where(function($query) use ($searchQuery) {
            $query->where('name', 'like', "%$searchQuery%")
                  ->orWhere('sku', 'like', "%$searchQuery%")
                  ->orWhere('specifications', 'like', "%$searchQuery%")
                  ->orWhere('product_description', 'like', "%$searchQuery%");
        })
        ->where("status", "1")
        ->paginate(9);
        $productIds = $showProducts->pluck('id')->toArray();
    
        // $galleryImages = product_gallery_images::whereIn('product_id', $productIds)
        //     ->select('product_id', 'images')
        //     ->pluck('images', 'product_id')
        //     ->all();
    
        // $showProducts = $products->map(function ($product) use ($galleryImages) {
        //     $productId = $product->id;
        //     $product->galleryImages = isset($galleryImages[$productId]) ? $galleryImages[$productId] : [];
        //     return $product;
        // });
    
        if (!$showProducts->isEmpty()) {
            $slug = sub_main_category::where('id', $showProducts[0]->sub_categories_id)->pluck('slug')->first();
        } else {
            $slug = null;
        }

        $allProducts = Product::with('brand', 'product_attribute')->where('status', '1')->get();
        $brandCounts = [];
        $paperSizeCounts = [];
        $speedCounts = [];
        foreach ($allProducts as $product) {
            $brandName = $product->brand->brand_name;
            if (!isset($brandCounts[$brandName])) {
                $brandCounts[$brandName] = 0;
            }
            $brandCounts[$brandName]++;
        }
        foreach ($allProducts as $product) {
            foreach ($product->product_attribute as $attribute) {
                $paperSize = $attribute->paper_size;

                if (!isset($paperSizeCounts[$paperSize])) {
                    $paperSizeCounts[$paperSize] = 0;
                }

                $paperSizeCounts[$paperSize]++;
            }
        }
        foreach ($allProducts as $product) {
            foreach ($product->product_attribute as $attribute) {
                $speed = $attribute->speed;

                if (!isset($speedCounts[$speed])) {
                    $speedCounts[$speed] = 0;
                }

                $speedCounts[$speed]++;
            }
        }
        
        return view('frontend.user.search')
        ->with('brandCounts', $brandCounts)
        ->with('paperSizeCounts', $paperSizeCounts)
        ->with('speedCounts', $speedCounts)
        ->with('showProducts', $showProducts)
        ->with('slug', $slug);
        //  ['filteredProducts' => $showProducts, 'products' => $products, 'slug' => $slug]);
    }

    public function applyFilters(Request $request)
    {
        $products = Product::query();
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        if ($minPrice !== null && $maxPrice !== null) {
            $minPrice = intval($minPrice);
            $maxPrice = intval($maxPrice);
            if ($minPrice <= $maxPrice) {
                $products->where('price', '>=', $minPrice)
                         ->where('price', '<=', $maxPrice);
            }
        }
        $brands = $request->input('brand');
        if ($brands) {
            $brandIds = Brands::whereIn('brand_name', $brands)->pluck('id')->toArray();
            $products->whereIn('brand_id', $brandIds);
        }
        $paperSizes = $request->input('paper_size');
        if ($paperSizes) {
            $products->whereHas('product_attribute', function ($query) use ($paperSizes) {
                $query->whereIn('paper_size', $paperSizes);
            });
        }
        $speeds = $request->input('speed');
        if ($speeds) {
            $products->whereHas('product_attribute', function ($query) use ($speeds) {
                $query->whereIn('speed', $speeds);
            });
        }
        
        $categorySlug = $request->input('category_slug');
        if ($categorySlug) {
            $category = sub_main_category::where('slug', $categorySlug)->first();
            if ($category) {
                $products->where('sub_categories_id', $category->id);
            }
        }
        $products->where('status', '1');
        // $sqlQuery = $products->toSql();
        // Log::info('SQL Query: ' . $sqlQuery);
        $perPage = 8;
        $filteredProducts = $products->paginate($perPage); 

        // Fetch gallery images for the filtered products
        $productIds = $filteredProducts->pluck('id');
        $galleryImages = product_gallery_images::whereIn('product_id', $productIds)
        ->select('product_id', 'images')
        ->get()
        ->groupBy('product_id');

        // Append gallery images to each product
        $filteredProducts->each(function ($product) use ($galleryImages) {
            $productId = $product->id;
            $product->galleryImages = $galleryImages[$productId] ?? [];
            $imagePath = public_path('images/product_images/' . ($product->galleryImages[0]->images ?? ''));
            $product->imageExists = file_exists($imagePath) ? true : false;
        });
        return response()->json($filteredProducts);

    }
}