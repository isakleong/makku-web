<?php

namespace App\Http\Controllers;

use App\Models\Partnership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PartnershipController extends Controller
{
    public function index()
    {
        $partnership = Partnership::all();

        return view('administrator.partnership', compact('partnership'));
    }

    public function create()
    {
        return view('administrator.partnership-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image',
            'logo' => 'image',
            'address' => 'nullable',
            'instagram' => 'nullable',
            'whatsapp' => 'nullable',
            'phoneNo' => 'nullable',
            'active' => 'nullable'
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
            $image->move($destinationPath, $imageName);

            $input['image'] = $destinationPath.$imageName;
        } else {
            unset($input['image']);
        }

        if($image = $request->file('logo')) {
            //commented because never trust client side inputs
            // $destinationPath = 'image/upload/';
            // $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            // $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            // $image->move($destinationPath, $imageName);

            $destinationPath = 'image/upload/';
            $generatedID = hexdec(uniqid());
            $imageName = $generatedID."-".time(). "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);

            $input['logo'] = $destinationPath.$imageName;
        } else {
            unset($input['logo']);
        }

        Partnership::create($input);

        return redirect('/admin/partnership')->withSuccess('Data Added Successfully!');
    }

    public function show(Partnership $partnership)
    {
        //
    }

    public function edit(Partnership $partnership)
    {
        return view('administrator.partnership-edit', compact('partnership'));
    }

    public function update(Request $request, Partnership $partnership)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image',
            'logo' => 'image',
            'address' => 'nullable',
            'instagram' => 'nullable',
            'whatsapp' => 'nullable',
            'phoneNo' => 'nullable',
            'active' => 'nullable'
        ]);

        if(!$request->has('active')) {
            $request->merge(['active'=>'0']);
        } else {
            $request->merge(['active'=>'1']);
        }

        if($request->has('discard-image')) {
            $request->merge(['image'=>null]);
            $path = public_path()."/".$partnership->image;
            File::delete($path);
        }
        if($request->has('discard-logo')) {
            $request->merge(['logo'=>null]);
            $path = public_path()."/".$partnership->logo;
            File::delete($path);
        }

        $input = $request->all();

        $imageDelete = "";
        if($image = $request->file('image')) {
            $imageDelete = public_path()."/".$partnership->image;

            //commented because never trust client side inputs
            // $destinationPath = 'image/upload/';
            // $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            // $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            // $image->move($destinationPath, $imageName);

            $destinationPath = 'image/upload/';
            $generatedID = hexdec(uniqid());
            $imageName = $generatedID."-".time(). "." .$image->getClientOriginalExtension();
            // $image->move($destinationPath, $imageName);
            Image::make($image)->resize(800, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.$imageName);

            $input['image'] = $destinationPath.$imageName;
        } else {
            unset($input['image']);
        }

        $logoDelete = "";
        if($image = $request->file('logo')) {
            $logoDelete = public_path()."/".$partnership->logo;

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

            $input['logo'] = $destinationPath.$imageName;
        } else {
            unset($input['logo']);
        }

        $partnership->update($input);

        if($imageDelete != ""){
            File::delete($imageDelete);
        }
        if($logoDelete != "") {
            File::delete($logoDelete);
        }

        return redirect('/admin/partnership')->withSuccess('Data Updated Successfully!');
    }

    public function destroy(Partnership $partnership)
    {
        $imageDelete = public_path()."/".$partnership->image;
        $logoDelete = public_path()."/".$partnership->logo;
        
        $partnership->delete();

        File::delete($imageDelete);
        File::delete($logoDelete);

        return redirect('/admin/partnership')->withSuccess('Data Deleted Successfully!');
    }
}
