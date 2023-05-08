<?php

namespace App\Http\Controllers;

use App\Models\KeyFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class KeyFeatureController extends Controller
{
    public function index()
    {
        $keyFeature = KeyFeature::all();

        return view('administrator.key-feature', compact('keyFeature'));
    }

    public function create()
    {
        return view('administrator.key-feature-create');
    }

    public function store(Request $request)
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
                Image::make($image)->resize(250, 250, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.$imageName);

                $input['image'] = $destinationPath.$imageName;
            } else {
                unset($input['image']);
            }
    
            KeyFeature::create($input);
    
            return redirect('/admin/master/keyfeature')->withSuccess('Data Added Successfully!');
        } catch (\Exception $e) {
            $isForeignKey = Str::contains($e->getMessage(), 'SQLSTATE[23000]');
            if($isForeignKey) {
                return redirect('/admin/master/keyfeature')->with('errorData', 'Key Feature cannot be added because the data is not unique.');
            } else {
                return redirect('/admin/master/keyfeature')->with('errorData', $e->getMessage());
            }
        }
    }

    public function show(KeyFeature $keyFeature)
    {
        //
    }

    public function edit(KeyFeature $keyfeature)
    {
        return view('administrator.key-feature-edit', compact('keyfeature'));
    }

    public function update(Request $request, KeyFeature $keyfeature)
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

        if($request->has('discard')) {
            $request->merge(['image'=>null]);
            $path = public_path()."/".$keyfeature->image;
            File::delete($path);
        }

        try {
            $input = $request->all();

            $imageDelete = "";
            if($image = $request->file('image')) {
                $imageDelete = public_path()."/".$keyfeature->image;

                //commented because never trust client side inputs
                // $destinationPath = 'image/upload/';
                // $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
                // $image->move($destinationPath, $imageName);

                $destinationPath = 'image/upload/';
                $generatedID = hexdec(uniqid());
                $imageName = $generatedID."-".time(). "." .$image->getClientOriginalExtension();
                // $image->move($destinationPath, $imageName);
                Image::make($image)->resize(250, 250, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.$imageName);

                $input['image'] = $destinationPath.$imageName;
            } else {
                if(!$request->has('discard')) {
                    unset($input['image']);
                }
            }

            $keyfeature->update($input);

            if($imageDelete != "") {
                File::delete($imageDelete);
            }

            return redirect('/admin/master/keyfeature')->withSuccess('Data Updated Successfully!');
        } catch (\Exception $e) {
            $isForeignKey = Str::contains($e->getMessage(), 'SQLSTATE[23000]');
            if($isForeignKey) {
                return redirect('/admin/master/keyfeature')->with('errorData', 'Key Feature cannot be updated because the data is not unique.');
            } else {
                return redirect('/admin/master/keyfeature')->with('errorData', $e->getMessage());
            }
        }
    }

    public function destroy(KeyFeature $keyfeature)
    {
        $imageDelete = public_path()."/".$keyfeature->image;

        $keyfeature->delete();

        File::delete($imageDelete);

        return redirect('/admin/master/keyfeature')->withSuccess('Data Deleted Successfully!');
    }
}
