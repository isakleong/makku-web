<?php

namespace App\Http\Controllers;

use App\Models\ProductBrand;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        try {
            $input = $request->all();
            ProductBrand::create($input);

            return redirect('/admin/product/brand')->withSuccess('Product Brand added successfully!');
        } catch (\Exception $e) {
            $isForeignKey = Str::contains($e->getMessage(), 'SQLSTATE[23000]');
            if($isForeignKey) {
                return redirect('/admin/product/brand')->with('errorData', 'Product Brand cannot be added because the data is not unique. Please make sure there are no duplicate name data.');
            } else {
                return redirect('/admin/product/brand')->with('errorData', $e->getMessage());
            }
        }
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

        try {
            $input = $request->all();

            $brand->update($input);

            return redirect('/admin/product/brand')->withSuccess('Product Brand updated successfully!');
        } catch (\Exception $e) {
            $isForeignKey = Str::contains($e->getMessage(), 'SQLSTATE[23000]');
            if($isForeignKey) {
                return redirect('/admin/product/brand')->with('errorData', 'Product Brand cannot be updated because the data is not unique. Please make sure there are no duplicate name or slug data.');
            } else {
                return redirect('/admin/product/brand')->with('errorData', $e->getMessage());
            }
        }
    }

    public function destroy(ProductBrand $brand)
    {
        try {
            $brand->delete();

            return redirect('/admin/product/brand')->withSuccess('Product Brand Deleted Successfully!');
        } catch (\Exception $e) {
            $isForeignKey = Str::contains($e->getMessage(), 'SQLSTATE[23000]');
            if($isForeignKey) {
                return redirect('/admin/product/brand')->with('errorData', 'Product Brand cannot be deleted because it is still referenced by other page (Product Item).');
            } else {
                return redirect('/admin/product/brand')->with('errorData', $e->getMessage());
            }
        }
    }
}
