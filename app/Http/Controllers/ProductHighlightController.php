<?php

namespace App\Http\Controllers;

use App\Models\ProductHighlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

        $productHighlight = ProductHighlight::where([
            'active' => 1,
            'orderNumber' => $request->orderNumber
        ])->get();

        $cntData = $productHighlight->count();
        if($cntData == 0) {
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
            }
    
            ProductHighlight::create($input);
    
            return redirect('/admin/master/producthighlight')->withSuccess('Data Added Successfully!');
        } else {
            $dataExist = "";
            $i = 0;
            foreach($productHighlight as $item) {
                if($i == $cntData-1) {
                    $dataExist.=$item->name_en;
                } else {
                    $dataExist.=$item->name_en.", ";
                }
                $i++;
            }
            return redirect('/admin/master/producthighlight')->with('error', $dataExist);
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

        $input = $request->all();

        $imageDelete = "";
        if($image = $request->file('image')) {
            $imageDelete = public_path()."/".$producthighlight->image;

            $destinationPath = 'image/upload/';
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['image'] = $destinationPath.$imageName;            
        } else {
            unset($input['image']);
        }

        $producthighlight->update($input);

        if($imageDelete != "") {
            File::delete($imageDelete);
        }

        return redirect('/admin/master/producthighlight')->withSuccess('Data Updated Successfully!');
    }

    public function destroy(ProductHighlight $producthighlight)
    {
        $imageDelete = public_path()."/".$producthighlight->image;
        
        $producthighlight->delete();

        File::delete($imageDelete);

        return redirect('/admin/master/producthighlight')->withSuccess('Data Deleted Successfully!');
    }
}
