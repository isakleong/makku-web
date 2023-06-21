<?php

namespace App\Http\Controllers;

use App\Models\ProductHighlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

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

        try {
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

                $input['image'] = $destinationPath.$imageName;
            }
    
            ProductHighlight::create($input);

            if (isset($input['image'])) {
                Image::make($image)->resize(800, 800, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.$imageName);
            }
    
            return redirect('/admin/master/producthighlight')->withSuccess('Product Highlight added successfully!');
        } catch (\Exception $e) {
            $isForeignKey = Str::contains($e->getMessage(), 'SQLSTATE[23000]');
            if($isForeignKey) {
                return redirect('/admin/master/producthighlight')->with('errorData', 'Product Highlight cannot be added because the data is not unique. Please make sure there are no duplicate name or order number data.');
            } else {
                return redirect('/admin/master/producthighlight')->with('errorData', $e->getMessage());
            }
        }
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

        try {
            $input = $request->all();

            $imageDelete = "";
            if($image = $request->file('image')) {
                $imageDelete = public_path()."/".$producthighlight->image;

                //commented because never trust client side inputs
                // $destinationPath = 'image/upload/';
                // $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
                // $image->move($destinationPath, $imageName);

                $destinationPath = 'image/upload/';
                $generatedID = hexdec(uniqid());
                $imageName = $generatedID."-".time(). "." .$image->getClientOriginalExtension();
                // $image->move($destinationPath, $imageName);

                $input['image'] = $destinationPath.$imageName;            
            } else {
                unset($input['image']);
            }

            $producthighlight->update($input);

            if (isset($input['image'])) {
                Image::make($image)->resize(800, 800, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.$imageName);
            }

            if($imageDelete != "") {
                File::delete($imageDelete);
            }

            return redirect('/admin/master/producthighlight')->withSuccess('Product Highlight updated successfully!');
        } catch (\Exception $e) {
            $isForeignKey = Str::contains($e->getMessage(), 'SQLSTATE[23000]');
            if($isForeignKey) {
                return redirect('/admin/master/producthighlight')->with('errorData', 'Product Highlight cannot be updated because the data is not unique. Please make sure there are no duplicate name or order number data.');
            } else {
                return redirect('/admin/master/producthighlight')->with('errorData', $e->getMessage());
            }
        }
    }

    public function destroy(ProductHighlight $producthighlight)
    {
        $imageDelete = public_path()."/".$producthighlight->image;
        
        $producthighlight->delete();

        File::delete($imageDelete);

        return redirect('/admin/master/producthighlight')->withSuccess('Product Highlight deleted successfully!');
    }
}
