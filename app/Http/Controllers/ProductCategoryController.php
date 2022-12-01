<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['image'] = $destinationPath.$imageName;
        } else {
            unset($input['image']);
        }

        ProductCategory::create($input);

        return redirect('/admin/product/category')->withSuccess('Data Added Successfully!');
    }

    public function show($locale, ProductCategory $product_category)
    {
        $availableLanguage = ['en', 'id'];

        if(in_array($locale, $availableLanguage)) {
            if($locale == "en") {
                $sectionTitle = 'News';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_en as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_en as highlight, description_en as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp'))
                ->get()->first();

            } elseif($locale == "id") {
                $sectionTitle = 'Berita';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_id as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_id as highlight, description_id as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp'))
                ->get()->first();
            }

            // dd($product_category);
            return view('home.our-product', compact(['sectionTitle', 'menubar', 'company', 'product_category']));
        }  
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

        $imageDelete = "";
        if($image = $request->file('image')) {
            $imageDelete = public_path()."/".$category->image;

            $destinationPath = 'image/upload/';
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['image'] = $destinationPath.$imageName;
        } else {
            unset($input['image']);
        }

        $category->slug = null;
        $category->update($input);

        if($imageDelete != "") {
            File::delete($imageDelete);
        }

        return redirect('/admin/product/category')->withSuccess('Data Updated Successfully!');
    }

    public function destroy(ProductCategory $category)
    {
        $imageDelete = public_path()."/".$category->image;

        $category->delete();

        File::delete($imageDelete);

        return redirect('/admin/product/category')->withSuccess('Data Deleted Successfully!');
    }
}
