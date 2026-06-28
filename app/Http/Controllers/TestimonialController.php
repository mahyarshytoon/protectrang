<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10',
        ]);

        $data = $request->only(['name', 'rating', 'comment']);

        // اگر تاریخ از فرم اومده بود (فقط برای ادمین)
        if ($request->has('created_at')) {
            $data['created_at'] = $request->created_at;
        }

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('testimonials', 'public');
            $data['avatar'] = $path;
        }

        Testimonial::create($data);

        return redirect()->back()->with('testimonial_success', '✅ نظر شما با موفقیت ثبت شد. پس از تایید نمایش داده خواهد شد.');
    }
}