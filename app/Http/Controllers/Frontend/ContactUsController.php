<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\Contact\AdminContactMailJob;
use App\Jobs\Contact\ContactMailJob;
use App\Models\User\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);
        if($data)
        {
            $contact  = ContactUs::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'company' => $request->company,
                'message' => $data['message']
            ]);
            if($contact)
            {
                dispatch(new ContactMailJob($request->all()));
                dispatch(new AdminContactMailJob($request->all()));
                return redirect()->back()->with('success', 'Message Send Successfully We Will Response You ASAP!'); 
            }
        }
        else
        {
            return redirect()->back()->withErrors($request->errors())->withInput();    
        }
    }
}
