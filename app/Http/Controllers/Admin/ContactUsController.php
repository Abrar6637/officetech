<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function show()
    {
        $contacts = ContactUs::orderBy('id','desc')->get();
        return view('admin.Contact-Us.index',compact('contacts'));
    }
}
