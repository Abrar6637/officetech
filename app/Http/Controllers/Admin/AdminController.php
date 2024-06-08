<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\addCategories;
use App\Models\Admin;
use App\Models\categories;
use App\Models\order;
use App\Models\Product;
use App\Models\sub_main_category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Admin Authentcator functions
    public function index(Request $request)
    {

        $categories = addCategories::all();
        $orders = order::all();
        $products = Product::all();
        $users = User::all();
        return view('admin.index')
            ->with('categories', $categories)
            ->with('orders', $orders)
            ->with('products', $products)
            ->with('users', $users);
    }
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $credentials = $request->only('email', 'password');
            if (Auth::guard('admin')->attempt($credentials, $request->get('remember'))) {
                $categories = addCategories::all();
                $orders = order::all();
                $products = Product::all();
                $users = User::all();
                return view('admin.index')
                    ->with('categories', $categories)
                    ->with('orders', $orders)
                    ->with('products', $products)
                    ->with('users', $users);
            } else {     
                $user = Admin::where('email', $request->email)->first();
                if($user == null){
                    return view('auth-login');
                }
                elseif ($user->email != $request->email) {
                    return view('auth-login')->with('error', 'The email address you entered is not registered.');
                } 
                elseif(!Hash::check($request->password, $user->password)) {
                    return view('auth-login');
                }
                return view('auth.login')->with('error', 'Invalid email or password.');
            }
        } else {
            return view('auth-login');
        }
    }
    
    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            session()->forget('error');
            return redirect()->route('admin.login'); 
        }
        return view('auth-login');
    }

    // Admin Authentcator functions ends


    // Showing Category Page
    public function showMainCategories()
    {
        $main_category = addCategories::orderBy('category_order')->get();
        return view('main-categories')->with('main_categories', $main_category);
    }
    public function showSubCategories()
    {
        $main_category = addCategories::orderBy('category_order')->get();
        $subCategories = sub_main_category::all();
        return view('sub-categories')->with('main_categories', $main_category)->with('subCategories', $subCategories);
    }
    public function showcategories()
    {

        $main_category = addCategories::all();
        $subCategories = sub_main_category::all();

        $categories = categories::all();

        $main_categories = addCategories::all();
        return view('Categories')->with('main_categories', $main_categories)->with('subCategories', $subCategories)->with('sub_sub_categories', $categories);
    }

    // Adding Main Category

    public function addCategory(Request $request)
    {
        // dd($request->all());
        $subCategories = sub_main_category::all();

        $rules = [
            'main_category_name' => 'required|string|max:255',
            'category_status' => 'required',
            'main_category_order' => 'max:255',
            'main_category_image' => 'image|mimes:jpg,png,jpeg,webp',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect()->route('show.main.categories')->withErrors($validator)->withInput();
        }
        if ($request->hasFile('main_category_image')) {
            $name = rand() . '.' . $request->file('main_category_image')->getClientOriginalExtension();
            $request->file('main_category_image')->move('images/category_images/', $name);
            $image = $name;
        } else {
            $image = null;
        }

        $slug = Str::slug($request->main_category_name, '-');

        $category = addCategories::create([
            'category_name' => $request->main_category_name,
            'status' => $request->category_status,
            'category_order' => $request->main_category_order,
            'slug' =>  $slug,
            'image' => $image,
        ]);

        if ($category) {
            $categories = addCategories::orderBy('category_order')->get();
            return redirect()->route('show.main.categories')->with('subCategories', $subCategories)->with('categories', $categories)->with('sub_sub_categories', $categories)->with('success', 'Category Added Successfully');
        }
    }

    // Adding Sub Category

    public function addSubCategory(Request $request)
    {
        $data = $request->validate([
            'main_category_id' => 'required|exists:add_categories,id',
            'sub_category_name' => 'required|string|max:255',
            'sub_category_status' => 'required',
            'sub_category_order' => 'max:255',
        ]);

        $slug = Str::slug($data['sub_category_name'], '-');
        if ($data) {
            $categoryOrder = empty($data['sub_category_order']) ? 0 : $data['sub_category_order'];
            $subCategory = sub_main_category::create([
                'sub_category_name' => $data['sub_category_name'],
                'parent_category_id' => $data['main_category_id'],
                'status' => $data['sub_category_status'],
                'category_order' => $categoryOrder,
                'slug' => $slug,
            ]);
            if ($subCategory) {
                $categories = addCategories::orderBy('category_order')->get();
                $subCategories = sub_main_category::all();
                return back()->with('subCategories', $subCategories)->with('categories', $categories)->with('sub_sub_categories', $categories)->with('success', 'Subcategory inserted successfully');
            }
        }
    }

    // Adding sub of sub categories

    public function addSubOfSubCategory(Request $request)
    {
        $maincategories = addCategories::orderBy('category_order')->get();
        $subCategories = sub_main_category::all();
        $categories = categories::all();

        // Validate the request data
        $data = $request->validate([
            'main_category_id' => 'required|exists:add_categories,id',
            'sub_category_id' => 'required|exists:sub_main_categories,id',
            'sub_sub_category_name' => 'required|string|max:255',
        ]);
        // Create the sub-sub-category
        $subSubCategory = categories::create([
            'main_category_id' => $data['main_category_id'],
            'sub_category_id' => $data['sub_category_id'],
            'sub_category_name' => $data['sub_sub_category_name'],
        ]);
        // Check if the sub-sub-category was created successfully
        if ($subSubCategory) {
            return redirect()->route('show.categories')->with('subCategories', $subCategories)->with('categories', $maincategories)->with('sub_sub_categories', $categories)->with('success', 'Subcategory inserted successfully');
        }
    }

    // Edit nd update main category

    public function edit_main_Category($id, $index)
    {
        $mainCategory = addCategories::find($id);
        return view('edit-category')->with('mainCategory', $mainCategory)
            ->with('index', $index);
    }

    public function update_main_Category(Request $request, $id)
    {
        // dd($request->all());
        $data = $request->validate([
            'main_category_name' => 'required|string|max:255',
            'category_status' => 'required',
            'main_category_order' => 'max:255',
            'image' => 'image|mimes:jpg,jpeg,png,webp',
        ]);

        if ($data) {
            $subCategory = addCategories::find($id);
            if ($request->hasFile('image')) {
                $name = rand() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move('images/category_images/', $name);
                $image = $name;
                $entities = addCategories::where('category_order', '>=', $request->main_category_order)
                    ->where('id', '!=', $id)
                    ->get();
    
                foreach ($entities as $entity) {
                    $entity->update([
                        'category_order' => $entity->category_order + 1,
                    ]);
                }
                $slug = Str::slug($data['main_category_name'], '-');
                $subCategory->update([
                    'category_name' => $data['main_category_name'],
                    'status' => $data['category_status'],
                    'category_order' => $request->main_category_order,
                    'slug' => $slug,
                    'image' => $image,
                ]);
    
                if ($subCategory) {
                    return redirect()->route('show.main.categories')->with('success', 'Sub Category updated successfully');
                }
            }
            else
            {
                $entities = addCategories::where('category_order', '>=', $request->main_category_order)
                    ->where('id', '!=', $id)
                    ->get();
    
                foreach ($entities as $entity) {
                    $entity->update([
                        'category_order' => $entity->category_order + 1,
                    ]);
                }
                $slug = Str::slug($data['main_category_name'], '-');
                $subCategory->update([
                    'category_name' => $data['main_category_name'],
                    'status' => $data['category_status'],
                    'category_order' => $request->main_category_order,
                    'slug' => $slug,
                ]);
    
                if ($subCategory) {
                    return redirect()->route('show.main.categories')->with('success', 'Sub Category updated successfully');
                }
            }
        }
    }


    // Edit nd update main category ends

    // Edit nd update sub category

    public function edit_sub_Category($id, $index)
    {
        $sub_Category = sub_main_category::find($id);
        $maincategories = addCategories::all();
        return view('edit-category')->with('sub_category', $sub_Category)->with('maincategories', $maincategories)
            ->with('index', $index);
    }

    public function update_sub_Category(Request $request, $id)
    {
        $data = $request->validate([
            'sub_category_name' => 'required|string|max:255',
            'main_category' => 'required|integer',
            'sub_category_status' => 'required',
        ]);
        if ($data) {
            $subCategory = sub_main_category::find($id);
            $slug = Str::slug($data['sub_category_name'], '-');
            $subCategory->update([
                'sub_category_name' => $data['sub_category_name'],
                'parent_category_id' => $data['main_category'],
                'status' => $data['sub_category_status'],
                'slug' => $slug
            ]);

            return redirect()->route('show.sub.categories')->with('success', 'Sub Category updated successfully');
        }
    }

    // Edit nd update sub category ends

    // Edit nd update sub of sub category

    public function edit_sub_sub_Category($id)
    {
        $categories = categories::find($id);
        return view('edit-category')->with('categories', $categories);
    }

    public function update_sub_sub_Category(Request $request, $id)
    {
        $data = $request->validate([
            'sub_sub_category_name' => 'required|string|max:255',
        ]);

        // Update the sub-sub-category
        $subSubCategory = categories::find($id);
        $subSubCategory->update([
            'sub_category_name' => $data['sub_sub_category_name'],
        ]);

        return redirect()->route('show.categories')->with('success', 'Sub Sub Category updated successfully');
    }

    // Edit nd update sub sub of sub category
    public function updateSubSubCategory(Request $request, $id)
    {
        // Validate the request data
        $data = $request->validate([
            'sub_sub_category_name' => 'required|string|max:255',
        ]);

        $subSubCategory = categories::find($id);
        $subSubCategory->update([
            'sub_category_name' => $data['sub_sub_category_name'],
        ]);

        return redirect()->route('show.categories')->with('success', 'Sub Sub Category updated successfully');
    }

    // Delete main Category and associated items

    public function deleteMainCategory($id)
    {
        $mainCategory = addCategories::find($id);

        if (!$mainCategory) {
            return redirect()->route('show.categories')->with('error', 'Category not found');
        }

        $mainCategory->subCategories()->delete();

        $mainCategory->subSubCategories()->delete();

        $mainCategory->delete();

        return back()->with('success', 'Category and associated items deleted successfully');
    }


    // Delete sub Category and associated items

    public function deleteSubCategory($id)
    {
        $subCategory = sub_main_category::find($id);

        if ($subCategory) {
            $subCategory->delete();

            return redirect()->route('show.sub.categories')->with('success', 'Sub Category deleted successfully');
        }

        // If the sub category is not found
        return redirect()->route('show.categori
        es')->with('error', 'Sub Category not found');
    }

    // Delete sub of sub Category

    public function deleteSub_sub_Category($id)
    {

        $categories = categories::find($id);

        if ($categories) {
            $categories->delete();

            return redirect()->route('show.categories')->with('success', 'Category deleted successfully');
        }

        return redirect()->route('show.categories')->with('error', 'Category not found');
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);
    
        $credentials = [
            'email' => Auth::guard('admin')->user()->email,
            'password' => $request->old_password,
        ];
    
        if (!Auth::guard('admin')->attempt($credentials)) {
            return response()->json(['success' => false, 'message' => 'The old password is incorrect.'], 422);
        }
    
        $admin = Auth::guard('admin')->user();
        $admin->password = Hash::make($request->password);
        $admin->save();
    
        return response()->json(['success' => true, 'message' => 'Password changed successfully.']);
    }
    public function changeUsername(Request $request)
{
    $request->validate([
        'old_username' => 'required',
        'new_username' => 'required',
    ]);

    $admin = Auth::guard('admin')->user();
    $admin->email = $request->new_username;
    $admin->save();

    return response()->json(['success' => true, 'message' => 'Username changed successfully.']);
}



}
