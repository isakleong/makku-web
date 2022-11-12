<?php

namespace App\Http\Controllers;

use App\Models\ProductHighlight;
use Illuminate\Http\Request;

class ProductHighlightController extends Controller
{
    public function index()
    {
        $productHighlight = ProductHighlight::all();

        return view('administrator.product-highlight', compact('productHighlight'));
    }

    public function create()
    {
        return view('administrator.product-highlight-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required',
            'name_id' => 'required',
            'image' => 'required|image',
            'orderNumber' => 'required'
        ]);

        if(!$request->has('active')) {
            $request->merge(['active'=>'0']);
        } else {
            $request->merge(['active'=>'1']);
        }

        $input = $request->all();

        if($image = $request->file('image')) {
            $destinationPath = 'image/upload/';
            $imageName = strtolower($request->name_id) . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            // $input['image'] = $imageName;
            $input['image'] = $destinationPath.$imageName;
        }

        ProductHighlight::create($input);

        return redirect('/admin/master/producthighlight')->withSuccess('Data Added Successfully!');
    }

    public function show(ProductHighlight $productHighlight)
    {
        //
    }

    public function edit(ProductHighlight $producthighlight)
    {
        return view('administrator.product-highlight-edit', compact('producthighlight'));
    }

    public function update(Request $request, ProductHighlight $producthighlight)
    {
        $request->validate([
            'name_en' => 'required',
            'name_id' => 'required',
            'image' => 'image',
            'orderNumber' => 'required'
        ]);

        if(!$request->has('active')) {
            $request->merge(['active'=>'0']);
        } else {
            $request->merge(['active'=>'1']);
        }

        $input = $request->all();

        if($image = $request->file('image')) {
            $destinationPath = 'image/upload/';
            $imageName = strtolower($request->name_id) . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            // $input['image'] = $imageName;
            $input['image'] = $destinationPath.$imageName;
        } else {
            unset($input['image']);
        }

        $producthighlight->update($input);

        return redirect('/admin/master/producthighlight')->withSuccess('Data Updated Successfully!');
    }

    public function destroy(ProductHighlight $producthighlight)
    {
        $producthighlight->delete();

        return redirect('/admin/master/producthighlight')->withSuccess('Data Deleted Successfully!');
    }
}
