<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function show()
    {
        $newsletters = Newsletter::orderBy('id','desc')->get();
        return view('admin.newsletter.index',compact('newsletters'));
    }
    public function store(Request $request)
    {
        $validate = $request->validate( [
            'email' => 'unique:newsletter,email',
        ]);
    
        if ($validate) {
            $newsletter = Newsletter::create([
                'email' => $request->email,
            ]);
            if ($newsletter)
            {
                return response()->json(['message' => 'You are subscribed.']);
            }
        }
    }
}
