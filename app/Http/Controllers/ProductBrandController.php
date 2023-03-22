<?php

namespace App\Http\Controllers;

use App\Models\ProductBrand;
use Cviebrock\EloquentSluggable\Services\SlugService;
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

        $brand = ProductBrand::where([
            'name' => $request->name,
        ])->get();

        $cntData = $brand->count();
        if($cntData == 0) {
            $input = $request->all();
            ProductBrand::create($input);
            return redirect('/admin/product/brand')->withSuccess('Data Added Successfully!');
        } else {
            return redirect('/admin/product/brand')->with('error', 'errordata');
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

        if($request->name == $brand->name) {
            $input = $request->all();

            if($request->slug == $brand->slug) {
                $brand->update($input);
            } else {
                $brand->slug = null;
                $slug = SlugService::createSlug(ProductBrand::class, 'slug', $input['slug']);
                $input['slug'] = $slug;

                $brand->update($input);
            }
            return redirect('/admin/product/brand')->withSuccess('Data Updated Successfully!');
        } else {
            $tempBrand = ProductBrand::where([
                'name' => $request->name,
            ])->get();
    
            $cntData = $tempBrand->count();
            if($cntData == 0) {
                $input = $request->all();

                if($request->slug == $brand->slug) {
                    $brand->update($input);
                } else {
                    $brand->slug = null;
                    $slug = SlugService::createSlug(ProductBrand::class, 'slug', $input['slug']);
                    $input['slug'] = $slug;

                    $brand->update($input);
                }
                return redirect('/admin/product/brand')->withSuccess('Data Updated Successfully!');
            } else {
                return redirect('/admin/product/brand')->with('error', 'errordata');
            }
        }
    }

    public function destroy(ProductBrand $brand)
    {
        $brand->delete();

        return redirect('/admin/product/brand')->withSuccess('Data Deleted Successfully!');
    }
}
