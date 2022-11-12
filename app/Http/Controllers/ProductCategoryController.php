<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $category = ProductCategory::all();

        return view('administrator.product-category', compact('category'));
    }

    public function create()
    {
        return view('administrator.product-category-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required',
            'name_id' => 'required',
            'image' => 'required|image'
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

        ProductCategory::create($input);

        return redirect('/admin/product/category')->withSuccess('Data Added Successfully!');
    }

    public function show(ProductCategory $productCategory)
    {
        //
    }

    public function edit(ProductCategory $category)
    {
        return view('administrator.product-category-edit', compact('category'));
    }

    public function update(Request $request, ProductCategory $category)
    {
        $request->validate([
            'name_en' => 'required',
            'name_id' => 'required',
            'image' => 'image'
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

        $category->update($input);

        return redirect('/admin/product/category')->withSuccess('Data Updated Successfully!');
    }

    public function destroy(ProductCategory $category)
    {
        $category->delete();

        return redirect('/admin/product/category')->withSuccess('Data Deleted Successfully!');
    }
}
