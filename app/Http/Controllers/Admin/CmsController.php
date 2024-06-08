<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PrivacyPolicy;
use App\Models\Admin\ReturnPolicy;
use App\Models\Admin\ServicePolicy;
use App\Models\Admin\ServicePlanPolicy;
use App\Models\Admin\PaymentPolicy;
use App\Models\Admin\AboutUs;
use App\Models\Admin\EcomPrintPackage;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    //Privacy Policy
    public function showPrivacyPolicy()
    {
        $privacyPolicies = PrivacyPolicy::all();
        return view('admin.privacy-policy.index', compact('privacyPolicies'));
    }

    public function addPrivacyPolicy()
    {
        return view('admin.privacy-policy.create');
    }
    public function editPrivacyPolicy($id)
    {
        $privacyPolicy = PrivacyPolicy::findOrFail($id);
        return view('admin.privacy-policy.create', compact('privacyPolicy'));
    }

    public function storePrivacyPolicy(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
            'status' => 'nullable|boolean',
        ]);
    
        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('privacy-policy-images', $imageName, 'public');
            $data['image'] = $imagePath;
        }
    
        if ($request->has('status') && $request->status) {
            PrivacyPolicy::where('status', true)->update(['status' => false]);
        }
    
        $privacyPolicy = PrivacyPolicy::create($data);
        $message = 'Privacy Policy Added Successfully';
    
        return redirect()->route('admin.privacy-policy.index')->with('success', $message);
    }

    public function updatePrivacyPolicy(Request $request, $id)
    {
        $privacyPolicy = PrivacyPolicy::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('privacy-policy-images', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        if ($request->has('status')) {
            $data['status'] = $request->status;
            if ($data['status']) {
                PrivacyPolicy::where('id', '!=', $privacyPolicy->id)->update(['status' => false]);
            }
        }
        $privacyPolicy->update($data);

        return redirect()->route('admin.privacy-policy.index')->with('success', 'Privacy Policy Updated Successfully');
    }
    public function destroyPrivacyPolicy($id)
    {
        $privacyPolicy = PrivacyPolicy::findOrFail($id);
        $privacyPolicy->delete();

        return redirect()->route('admin.privacy-policy.index')->with('success', 'Privacy Policy Deleted Successfully');
    }

    //Return Policy
    public function showReturnPolicy()
    {
        $returnPolicies = ReturnPolicy::all();
        return view('admin.return-policy.index', compact('returnPolicies'));
    }

    public function addReturnPolicy()
    {
        return view('admin.return-policy.create');
    }
    public function editReturnPolicy($id)
    {
        $returnPolicy = ReturnPolicy::findOrFail($id);
        return view('admin.return-policy.create', compact('returnPolicy'));
    }

    public function storeReturnPolicy(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
            'status' => 'nullable|boolean',
        ]);
    
        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('return-policy-images', $imageName, 'public');
            $data['image'] = $imagePath;
        }
        if ($request->has('status') && $request->status) {
            ReturnPolicy::where('status', true)->update(['status' => false]);
        }
        $returnPolicy = ReturnPolicy::create($data);
        $message = 'Return Policy Added Successfully';
        return redirect()->route('admin.return-policy.index')->with('success', $message);
    }

    public function updateReturnPolicy(Request $request, $id)
    {
        $returnPolicy = ReturnPolicy::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('return-policy-images', $imageName, 'public');
            $data['image'] = $imagePath;
        }
        if ($request->has('status')) {
            $data['status'] = $request->status;
            if ($data['status']) {
                ReturnPolicy::where('id', '!=', $returnPolicy->id)->update(['status' => false]);
            }
        }
        $returnPolicy->update($data);

        return redirect()->route('admin.return-policy.index')->with('success', 'Return Policy Updated Successfully');
    }
    public function destroyReturnPolicy($id)
    {
        $returnPolicy = ReturnPolicy::findOrFail($id);
        $returnPolicy->delete();

        return redirect()->route('admin.return-policy.index')->with('success', 'Return Policy Deleted Successfully');
    }

    //Service Policy
    public function showServicePolicy()
    {
        $servicePolicies = ServicePolicy::all();
        return view('admin.service-policy.index', compact('servicePolicies'));
    }

    public function addServicePolicy()
    {
        return view('admin.service-policy.create');
    }
    public function editServicePolicy($id)
    {
        $servicePolicy = ServicePolicy::findOrFail($id);
        return view('admin.service-policy.create', compact('servicePolicy'));
    }

    public function storeServicePolicy(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
            'status' => 'nullable|boolean',
        ]);
    
        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('service-policy-images', $imageName, 'public');
            $data['image'] = $imagePath;
        }
        if ($request->has('status') && $request->status) {
            ServicePolicy::where('status', true)->update(['status' => false]);
        }
        $servicePolicy = ServicePolicy::create($data);
        $message = 'Service Policy Added Successfully';
    
        return redirect()->route('admin.service-policy.index')->with('success', $message);
    }

    public function updateServicePolicy(Request $request, $id)
    {
        $servicePolicy = ServicePolicy::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('service-policy-images', $imageName, 'public');
            $data['image'] = $imagePath;
        }
        if ($request->has('status')) {
            $data['status'] = $request->status;
            if ($data['status']) {
                ServicePolicy::where('id', '!=', $servicePolicy->id)->update(['status' => false]);
            }
        }
        $servicePolicy->update($data);

        return redirect()->route('admin.service-policy.index')->with('success', 'Service Policy Updated Successfully');
    }
    public function destroyServicePolicy($id)
    {
        $servicePolicy = ServicePolicy::findOrFail($id);
        $servicePolicy->delete();

        return redirect()->route('admin.service-policy.index')->with('success', 'Service Policy Deleted Successfully');
    }

    //Service Plan Policy
    public function showServicePlanPolicy()
    {
        $servicePlanPolicies = ServicePlanPolicy::all();
        return view('admin.service-plan-policy.index', compact('servicePlanPolicies'));
    }

    public function addServicePlanPolicy()
    {
        return view('admin.service-plan-policy.create');
    }
    public function editServicePlanPolicy($id)
    {
        $servicePlanPolicy = ServicePlanPolicy::findOrFail($id);
        return view('admin.service-plan-policy.create', compact('servicePlanPolicy'));
    }

    public function storeServicePlanPolicy(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
            'status' => 'nullable|boolean',
        ]);
    
        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('service-plan-policy-images', $imageName, 'public');
            $data['image'] = $imagePath;
        }
        if ($request->has('status') && $request->status) {
            ServicePlanPolicy::where('status', true)->update(['status' => false]);
        }
        $servicePlanPolicy = ServicePlanPolicy::create($data);
        $message = 'Service Plan Policy Added Successfully';
    
        return redirect()->route('admin.service-plan-policy.index')->with('success', $message);
    }

    public function updateServicePlanPolicy(Request $request, $id)
    {
        $servicePlanPolicy = ServicePlanPolicy::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('service-plan-policy-images', $imageName, 'public');
            $data['image'] = $imagePath;
        }
        if ($request->has('status')) {
            $data['status'] = $request->status;
            if ($data['status']) {
                ServicePlanPolicy::where('id', '!=', $servicePlanPolicy->id)->update(['status' => false]);
            }
        }
        $servicePlanPolicy->update($data);

        return redirect()->route('admin.service-plan-policy.index')->with('success', 'Service Plan Policy Updated Successfully');
    }
    public function destroyServicePlanPolicy($id)
    {
        $servicePlanPolicy = ServicePlanPolicy::findOrFail($id);
        $servicePlanPolicy->delete();

        return redirect()->route('admin.service-plan-policy.index')->with('success', 'Service Plan Policy Deleted Successfully');
    }

    //About Us
    public function showAboutUs()
    {
        $aboutUs = AboutUs::all();
        return view('admin.about-us.index', compact('aboutUs'));
    }

    public function addAboutUs()
    {
        return view('admin.about-us.create');
    }
    public function editAboutUs($id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        return view('admin.about-us.create', compact('aboutUs'));
    }

    public function storeAboutUs(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
            'status' => 'nullable|boolean',
        ]);
    
        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('about-us-images', $imageName, 'public');
            $data['image'] = $imagePath;
        }
        if ($request->has('status') && $request->status) {
            AboutUs::where('status', true)->update(['status' => false]);
        }
        $aboutUs = AboutUs::create($data);
        $message = 'About Us Added Successfully';
    
        return redirect()->route('admin.about-us.index')->with('success', $message);
    }

    public function updateAboutUs(Request $request, $id)
    {
        $aboutUs = AboutUs::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('about-us-images', $imageName, 'public');
            $data['image'] = $imagePath;
        }
        if ($request->has('status')) {
            $data['status'] = $request->status;
            if ($data['status']) {
                AboutUs::where('id', '!=', $aboutUs->id)->update(['status' => false]);
            }
        }
        $aboutUs->update($data);

        return redirect()->route('admin.about-us.index')->with('success', 'About Us Updated Successfully');
    }
    public function destroyAboutUs($id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        $aboutUs->delete();

        return redirect()->route('admin.about-us.index')->with('success', 'About Us Deleted Successfully');
    }
    
       //Payment Policy
       public function showPaymentPolicy()
       {
           $paymentPolicies = PaymentPolicy::all();
           return view('admin.payment-policy.index', compact('paymentPolicies'));
       }
   
       public function addPaymentPolicy()
       {
           return view('admin.payment-policy.create');
       }
       public function editPaymentPolicy($id)
       {
           $paymentPolicy = PaymentPolicy::findOrFail($id);
           return view('admin.payment-policy.create', compact('paymentPolicy'));
       }
   
       public function storePaymentPolicy(Request $request)
       {
           $data = $request->validate([
               'name' => 'required',
               'content' => 'required',
               'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
               'status' => 'nullable|boolean',
           ]);
       
           if ($request->hasFile('image')) {
               $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
               $imagePath = $request->file('image')->storeAs('payment-policy-images', $imageName, 'public');
               $data['image'] = $imagePath;
           }
       
           if ($request->has('status') && $request->status) {
               PaymentPolicy::where('status', true)->update(['status' => false]);
           }
       
           $paymentPolicy = PaymentPolicy::create($data);
           $message = 'Payment Policy Added Successfully';
       
           return redirect()->route('admin.payment-policy.index')->with('success', $message);
       }
   
       public function updatePaymentPolicy(Request $request, $id)
       {
           $paymentPolicy = PaymentPolicy::findOrFail($id);
   
           $data = $request->validate([
               'name' => 'required',
               'content' => 'required',
               'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
               'status' => 'nullable|boolean',
           ]);
   
           if ($request->hasFile('image')) {
               $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
               $imagePath = $request->file('image')->storeAs('payment-policy-images', $imageName, 'public');
               $data['image'] = $imagePath;
           }
           if ($request->has('status')) {
            $data['status'] = $request->status;
            if ($data['status']) {
                PaymentPolicy::where('id', '!=', $paymentPolicy->id)->update(['status' => false]);
            }
        }
           $paymentPolicy->update($data);
   
           return redirect()->route('admin.payment-policy.index')->with('success', 'Payment Policy Updated Successfully');
       }
       public function destroyPaymentPolicy($id)
       {
           $paymentPolicy = PaymentPolicy::findOrFail($id);
           $paymentPolicy->delete();
   
           return redirect()->route('admin.payment-policy.index')->with('success', 'Payment Policy Deleted Successfully');
       }
   
    
       //Ecom Print Package
       public function showEcomPrintPackage()
       {
           $ecomPrintPackages = EcomPrintPackage::all();
           return view('admin.ecom-print-package.index', compact('ecomPrintPackages'));
       }
   
       public function addEcomPrintPackage()
       {
           return view('admin.ecom-print-package.create');
       }

       public function editEcomPrintPackage($id)
       {
           $ecomPrintPackage = EcomPrintPackage::findOrFail($id);
           return view('admin.ecom-print-package.create', compact('ecomPrintPackage'));
       }
   
       public function storeEcomPrintPackage(Request $request)
       {
           $data = $request->validate([
               'name' => 'required',
               'content' => 'required',
               'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
               'status' => 'nullable|boolean',
           ]);
           if ($request->hasFile('image')) {
               $file = $request->file('image');
               $fileName = $file->getClientOriginalName();
               $file->move('images/ecom-print-package', $fileName);
               $data['image'] = $fileName;
           }
       
           if ($request->has('status') && $request->status) {
               EcomPrintPackage::where('status', true)->update(['status' => false]);
           }
       
           $ecomPrintPackage = EcomPrintPackage::create($data);
           $message = 'Ecommerce Print Package Added Successfully';
       
           return redirect()->route('admin.ecom-print-package.index')->with('success', $message);
       }
   
       public function updateEcomPrintPackage(Request $request, $id)
       {
           $ecomPrintPackage = EcomPrintPackage::findOrFail($id);
   
           $data = $request->validate([
               'name' => 'required',
               'content' => 'required',
               'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
               'status' => 'nullable|boolean',
           ]);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = $file->getClientOriginalName();
                $file->move('images/ecom-print-package', $fileName);
                $data['image'] = $fileName;

                if ($ecomPrintPackage->image) {
                    $oldImagePath = public_path('images/ecom-print-package/' . $ecomPrintPackage->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }

           if ($request->has('status')) {
            $data['status'] = $request->status;
            if ($data['status']) {
                EcomPrintPackage::where('id', '!=', $ecomPrintPackage->id)->update(['status' => false]);
            }
        }
           $ecomPrintPackage->update($data);
   
           return redirect()->route('admin.ecom-print-package.index')->with('success', 'Ecommerce Print Package Updated Successfully');
       }

       public function destroyEcomPrintPackage($id)
       {
           $ecomPrintPackage = EcomPrintPackage::findOrFail($id);
           $ecomPrintPackage->delete();
   
           return redirect()->route('admin.ecom-print-package.index')->with('success', 'Ecommerce Print Package Deleted Successfully');
       }
   
}
