<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonial = Testimonial::all();

        return view('administrator.testimonial', compact('testimonial'));
    }

    public function create()
    {
        return view('administrator.testimonial-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content_en' => 'required',
            'content_id' => 'required',
            'author' => 'required'
        ]);

        if(!$request->has('active')) {
            $request->merge(['active'=>'0']);
        } else {
            $request->merge(['active'=>'1']);
        }

        $input = $request->all();

        Testimonial::create($input);

        return redirect('/admin/testimonial')->withSuccess('Testimonial added successfully!');
    }

    public function show(Testimonial $testimonial)
    {
        //
    }

    public function edit(Testimonial $testimonial)
    {
        return view('administrator.testimonial-edit', compact('testimonial'));
    }


    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'content_en' => 'required',
            'content_id' => 'required',
            'author' => 'required'
        ]);

        if(!$request->has('active')) {
            $request->merge(['active'=>'0']);
        } else {
            $request->merge(['active'=>'1']);
        }

        $input = $request->all();

        $testimonial->update($input);

        return redirect('/admin/testimonial')->withSuccess('Testimonial updated successfully!');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect('/admin/testimonial')->withSuccess('Testimonial deleted successfully!');
    }
}
