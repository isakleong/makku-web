<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::join('product_category', 'product_category.id', '=', 'product.categoryID')
            ->join('product_brand', 'product_brand.id', '=', 'product.brandID')
            ->select(
                "product.id",
                "product.name_en",
                "product.name_id",
                "product.slug",
                "product.image",
                "product.active",
                "product_category.name_en as categoryName",
                "product_brand.name as brandName"
            )
            ->get();

        // $product = Product::select(
        //     "product.id",
        //     "product.name_en",
        //     "product.name_id",
        //     "product.image",
        //     "product.active",
        //     "product_category.name_en as categoryName",
        //     "product_brand.name as brandName"
        // )
        // ->join("product_category", "product_category.id", "=", "product.categoryID")
        // ->join("product_brand", "product_brand.id", "=", "product.brandID")
        // ->get();

        return view('administrator.product', compact('product'));
    }

    public function create()
    {
        // $category = ProductCategory::all();
        $category = ProductCategory::where('active', 1)->get();

        // $brand = ProductBrand::all();
        $brand = ProductBrand::where('active', 1)->get();
        return view('administrator.product-create', compact(['category', 'brand']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoryID' => 'required',
            'brandID' => 'required',
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
            //commented because never trust client side inputs
            // $destinationPath = 'image/upload/';
            // $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            // $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            // $image->move($destinationPath, $imageName);

            $destinationPath = 'image/upload/';
            $generatedID = hexdec(uniqid());
            $imageName = $generatedID."-".time(). "." .$image->getClientOriginalExtension();
            // $image->move($destinationPath, $imageName);
            Image::make($image)->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.$imageName);

            $input['image'] = $destinationPath.$imageName;
        } else {
            unset($input['image']);
        }

        //custom slug handler (indonesia or english)
        if($request->slug == 'id') {
            $slug = SlugService::createSlug(Product::class, 'slug', $input['name_id']);
            $input['slug'] = $slug;
        } else {
            $slug = SlugService::createSlug(Product::class, 'slug', $input['name_en']);
            $input['slug'] = $slug;
        }

        Product::create($input);

        return redirect('/admin/product/item')->withSuccess('Data Added Successfully!');
    }

    public function show(Product $product)
    {

    }

    public function edit(Product $item)
    {
        $category = ProductCategory::all();
        $brand = ProductBrand::all();

        $categorySelected = DB::table('product_category')->where('id', $item->categoryID)->first();
        $brandSelected = DB::table('product_brand')->where('id', $item->brandID)->first();

        return view('administrator.product-edit', compact(['item', 'category', 'brand', 'categorySelected', 'brandSelected']));
    }

    public function update(Request $request, Product $item)
    {
        $request->validate([
            'categoryID' => 'required',
            'brandID' => 'required',
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
            $imageDelete = public_path()."/".$item->image;

            //commented because never trust client side inputs
            // $destinationPath = 'image/upload/';
            // $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            // $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            // $image->move($destinationPath, $imageName);

            $destinationPath = 'image/upload/';
            $generatedID = hexdec(uniqid());
            $imageName = $generatedID."-".time(). "." .$image->getClientOriginalExtension();
            // $image->move($destinationPath, $imageName);
            Image::make($image)->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.$imageName);

            $input['image'] = $destinationPath.$imageName;
        } else {
            unset($input['image']);
        }

        //uncomment, prevent slug update when it's not needed
        // $item->slug = null;
        // $slug = SlugService::createSlug(Product::class, 'slug', $input['slug']);
        // $input['slug'] = $slug;

        $item->update($input);

        if($imageDelete != "") {
            File::delete($imageDelete);
        }

        return redirect('/admin/product/item')->withSuccess('Data Updated Successfully!');
    }

    public function destroy(Product $item)
    {
        $imageDelete = public_path()."/".$item->image;

        $item->delete();

        File::delete($imageDelete);

        return redirect('/admin/product/item')->withSuccess('Data Deleted Successfully!');
    }
}
