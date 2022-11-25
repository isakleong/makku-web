<?php

namespace App\Http\Controllers;

use App\Models\KeyFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

        $keyFeature = KeyFeature::where([
            'active' => 1,
            'orderNumber' => $request->orderNumber
        ])->get();

        $cntData = $keyFeature->count();
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
                // $input['image'] = $imageName;
                $input['image'] = $destinationPath.$imageName;
            } else {
                unset($input['image']);
            }
    
            KeyFeature::create($input);
    
            return redirect('/admin/master/keyfeature')->withSuccess('Data Added Successfully!');
        } else {
            $dataExist = "";
            $i = 0;
            foreach($keyFeature as $item) {
                if($i == $cntData-1) {
                    $dataExist.=$item->name_en;
                } else {
                    $dataExist.=$item->name_en.", ";
                }
                $i++;
            }
            return redirect('/admin/master/keyfeature')->with('error', $dataExist);
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

        $input = $request->all();

        $imageDelete = "";
        if($image = $request->file('image')) {
            $imageDelete = public_path()."/".$keyfeature->image;

            $destinationPath = 'image/upload/';
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
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
    }

    public function destroy(KeyFeature $keyfeature)
    {
        $imageDelete = public_path()."/".$keyfeature->image;

        $keyfeature->delete();

        File::delete($imageDelete);

        return redirect('/admin/master/keyfeature')->withSuccess('Data Deleted Successfully!');
    }
}
