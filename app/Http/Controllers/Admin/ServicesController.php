<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Services;
use App\Models\RequestService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServicesController extends Controller
{
    public function show()
    {
        $services = Services::all();
        return view('admin.Services.index',compact('services'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'service_name' => 'required',
            'service_status' => 'required',
        ]);
        if ($data) {
            if ($request->hasFile('service_image')) {
                $image_validate = $request->validate([
                    'service_image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000'
                ]); 
                if ($image_validate) {   
                    $imageName = Str::slug($request->service_name). '.' . $request->file('service_image')->getClientOriginalExtension();
                    $image = $request->file('service_image')->storeAs('services-images',$imageName,'public_images');
                    $slug = Str::slug($request->service_name);
                    $service_create = Services::create([
                        'name' => $data['service_name'],
                        'image' => $image,
                        'slug' => $slug,
                        'status' => $data['service_status']
                    ]);
                    if ($service_create) {
                        return redirect()->route('all.services')->with('success','Service Created Successfully');
                    }
                }
            }
            else
            {
                $slug = Str::slug($request->service_name);
                $service_create = Services::create([
                    'name' => $data['service_name'],
                    'slug' => $slug,
                    'status' => $data['service_status']
                ]);
                if ($service_create) {
                    return redirect()->route('all.services')->with('success','Service Created Successfully');
                }
            }
        }
        else
        {
            return redirect()->route('all.services')->with('error', 'Error adding Slider.')->withInput();
        }
    }
    public function editService($id)
    {
        $service = Services::find($id);
        return view('admin.Services.edit-service',compact('service'));
    }
    public function updateService(Request $request,$id)
    {
        
        $data = $request->validate([
            'name' => 'required',
        ]);
        if($data)
        {
            if($request->hasFile('service_image'))
            {
                $image_validate = $request->validate([
                    'service_image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000'
                ]); 
                if($image_validate)
                {
                    $imageName = Str::slug($request->name) . '.' . $request->file('service_image')->getClientOriginalExtension();
                    $image = $request->file('service_image')->storeAs('category_images', $imageName, 'public_images');
                    $service = Services::find($id);
                    $slug = Str::slug($request->name);
                    $update = $service->update([
                        'name' => $data['name'],
                        'image' => $image,
                        'slug' =>  $slug,
                        'status' => $request->service_status,
                    ]);
                    if($update)
                    {
                        return redirect()->route('all.services')->with('success','Service Edited Successfuly');
                    }
                } 
            }
            else
            {
                $service = Services::find($id);
                $slug = Str::slug($request->name);
                $update = $service->update([
                    'name' => $data['name'],
                    'slug' =>  $slug,
                    'status' => $request->service_status,
                ]);
                if($update)
                {
                    return redirect()->route('all.services')->with('success','Service Edited Successfuly');
                }
            }
        }
    }
    public function deleteService($id)
    {
        $service = Services::find($id);

        if ($service) {
            $service->delete();
            return redirect()->back()->with('success', 'Service deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Service not found.');
        }
    }
    public function showServicesCall()
    {
        $ServicesCall = RequestService::where('service_id', '1')
        ->orderBy('id', 'desc')
        ->with(['service', 'user', 'order.customer'])
        ->get();

        
        if($ServicesCall)
        {
            return view('admin.Services.service-call')->with('ServicesCall', $ServicesCall);
        }
    }
    public function showServicesContract()
    {
        $ServicesContract =  RequestService::where('service_id', '2')
        ->orderBy('id', 'desc')
        ->with(['service', 'user', 'order.customer','order.productQuantity'])
        ->get();
        if($ServicesContract)
        {
            return view('admin.Services.service-contract')->with('ServicesContract', $ServicesContract);
        }
    }
    public function updateServicesCall($id)
    {
        $ServicesCall = RequestService::where('id', $id)->first();
    
        if ($ServicesCall) {
            if ($ServicesCall->status == '1') {
                $status = '0';
            } else {
                $status = '1'; 
            }
    
            $ServicesCall->status = $status;
            $ServicesCall->update();
    
            return redirect()->back()->with('success', 'Service Call Status Updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Service call not found.');
        }
    }

    public function updateServicesContract($id)
    {
        $ServicesContract = RequestService::where('id',$id)->first();
        if ($ServicesContract) {
            $ServicesContract->status = '1';
            $ServicesContract->update();
    
            return redirect()->back()->with('success', 'Service Contrcat Status Updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Service Contrcat not found.');
        }
    }
    public function declineServicesContract($id)
    {
        $ServicesContract = RequestService::where('id',$id)->first();
        if ($ServicesContract) {
            $ServicesContract->status = '0';
            $ServicesContract->update();
    
            return redirect()->back()->with('success', 'Service Contrcat Status Updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Service Contrcat not found.');
        }
    }
    public function declineServicesCall($id)
    {
        $ServicesContract = RequestService::where('id',$id)->first();
        if ($ServicesContract) {
            $ServicesContract->status = '0';
            $ServicesContract->update();
    
            return redirect()->back()->with('success', 'Service Call Status Updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Service Call not found.');
        }
    }
    public function deleteServiceRequest($id)
    {
        $deleteRequest = RequestService::findOrFail($id);
        $deleteRequest->delete();
        return redirect()->back()->with('success', 'Service Request Deleted successfully.');
    }
    public function deleteCallRequest($id)
    {
        $deleteRequest = RequestService::findOrFail($id);
        $deleteRequest->delete();
        return redirect()->back()->with('success', 'Service Request Deleted successfully.');
    }
}
