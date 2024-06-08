<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Reviews;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function show()
    {
        $reviews = Reviews::orderBy('id', 'desc')->get();
        return view('admin.Reviews.reviews',compact('reviews'));
    }
    public function store(Request $request)
    {
        $reviews = Reviews::create([
            'rating' => $request->star,
            'review' => $request->review,
            'name' => $request->name,
            'advantages' => $request->advantages,
            'flaws' => $request->disadvantage,
            'email' => $request->email,
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
        ]);
        if ($reviews) {
            return redirect()->back()->with('success', 'Review Submitted Successfully!');
        }
        else
        {
            return redirect()->back()->with('error', 'Failed to Submit the Review.');
        }
    }
    public function update(Request $request,$id)
    {
        $status = $request->query('status');
        $review = Reviews::find($id);
        $review->status = $status;
        $update = $review->update();
        if ($update) {
            return redirect()->back()->with('success', 'Review Updated Successfully!');
        }
    }
}
