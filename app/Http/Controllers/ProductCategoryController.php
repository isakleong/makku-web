<?php

namespace App\Http\Controllers;

use App\Models\MenuBar;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;

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

        try {
            $input = $request->all();

            if($image = $request->file('image')) {
                $destinationPath = 'image/upload/';
                $generatedID = hexdec(uniqid());
                $imageName = $generatedID."-".time(). "." .$image->getClientOriginalExtension();

                $input['image'] = $destinationPath.$imageName;
            } else {
                unset($input['image']);
            }

            //custom slug handler (indonesia or english)
            if($request->slug == 'id') {
                $slug = SlugService::createSlug(ProductCategory::class, 'slug', $input['name_id']);
                $input['slug'] = $slug;
            } else {
                $slug = SlugService::createSlug(ProductCategory::class, 'slug', $input['name_en']);
                $input['slug'] = $slug;
            }

            ProductCategory::create($input);

            if (isset($input['image'])) {
                Image::make($image)->resize(800, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($input['image']);
            }

            return redirect('/admin/product/category')->withSuccess('Product Category added successfully!');
        } catch (\Exception $e) {
            $isForeignKey = Str::contains($e->getMessage(), 'SQLSTATE[23000]');
            if($isForeignKey) {
                return redirect('/admin/product/category')->with('errorData', 'Product Category cannot be added because the data is not unique. Please make sure there are no duplicate name or slug data.');
            } else {
                return redirect('/admin/product/category')->with('errorData', $e->getMessage());
            }
        }
    }

    public function show($locale, ProductCategory $product_category)
    {
        $availableLanguage = ['en', 'id'];

        if(in_array($locale, $availableLanguage)) {
            Session::put('languagedata', $locale);

            if($locale == "en") {
                $sectionTitle = 'News';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_en as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_en as highlight, description_en as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp, phone'))
                ->get()->first();

            } elseif($locale == "id") {
                $sectionTitle = 'Berita';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_id as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_id as highlight, description_id as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp, phone'))
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
        
        try {
            $input = $request->all();

            $imageDelete = "";
            if($image = $request->file('image')) {
                $imageDelete = public_path()."/".$category->image;

                $destinationPath = 'image/upload/';
                $generatedID = hexdec(uniqid());
                $imageName = $generatedID."-".time(). "." .$image->getClientOriginalExtension();

                $input['image'] = $destinationPath.$imageName;
            } else {
                unset($input['image']);
            }

            $category->update($input);

            if (isset($input['image'])) {
                Image::make($image)->resize(800, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.$imageName);
            }

            if($imageDelete != "") {
                File::delete($imageDelete);
            }

            //update menubar slug
            $menubar = MenuBar::where('categoryID', $category->id)->get();
            for($i=0; $i<$menubar->count(); $i++) {
                $str_split = explode('/', $menubar[$i]->refer);
                $menubar[$i]->update(array('refer' => $str_split[0].'/'.$category->slug));
            }

            return redirect('/admin/product/category')->withSuccess('Product Category updated successfully!');
        } catch (\Exception $e) {
            $isForeignKey = Str::contains($e->getMessage(), 'SQLSTATE[23000]');
            if($isForeignKey) {
                return redirect('/admin/product/category')->with('errorData', 'Product Category cannot be updated because the data is not unique. Please make sure there are no duplicate name or slug data.');
            } else {
                return redirect('/admin/product/category')->with('errorData', $e->getMessage());
            }
        }
    }

    public function destroy(ProductCategory $category)
    {
        try {
            $imageDelete = public_path()."/".$category->image;
            $category->delete();
            File::delete($imageDelete);

            return redirect('/admin/product/category')->withSuccess('Product Category deleted successfully!');
          } catch (\Exception $e) {
            $isForeignKey = Str::contains($e->getMessage(), 'SQLSTATE[23000]');
            if($isForeignKey) {
                return redirect('/admin/product/category')->with('errorData', 'Product Category cannot be deleted because it is still referenced by other page (Menu Bar or Product Item).');
            } else {
                return redirect('/admin/product/category')->with('errorData', $e->getMessage());
            }
        }
    }
}
