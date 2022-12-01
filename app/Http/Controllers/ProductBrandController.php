<?php

namespace App\Http\Controllers;

use App\Models\ProductBrand;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductBrandController extends Controller
{
    public function index()
    {
        $brand = ProductBrand::all();

        return view('administrator.product-brand', compact('brand'));
    }

    public function create()
    {
        return view('administrator.product-brand-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        if(!$request->has('active')) {
            $request->merge(['active'=>'0']);
        } else {
            $request->merge(['active'=>'1']);
        }

        $input = $request->all();

        ProductBrand::create($input);

        return redirect('/admin/product/brand')->withSuccess('Data Added Successfully!');
    }

    public function show(ProductBrand $productBrand)
    {
        //
    }

    public function edit(ProductBrand $brand)
    {
        return view('administrator.product-brand-edit', compact('brand'));
    }

    public function update(Request $request, ProductBrand $brand)
    {
        $request->validate([
            'name' => 'required'
        ]);

        if(!$request->has('active')) {
            $request->merge(['active'=>'0']);
        } else {
            $request->merge(['active'=>'1']);
        }

        $input = $request->all();

        $brand->slug = null;
        $brand->update($input);

        return redirect('/admin/product/brand')->withSuccess('Data Updated Successfully!');
    }

    public function destroy(ProductBrand $brand)
    {
        $brand->delete();

        return redirect('/admin/product/brand')->withSuccess('Data Deleted Successfully!');
    }
}
