<?php

namespace App\Http\Controllers;

use App\Models\Partnership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
            $destinationPath = 'image/upload/';
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['image'] = $destinationPath.$imageName;
        } else {
            unset($input['image']);
        }

        if($image = $request->file('logo')) {
            $destinationPath = 'image/upload/';
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
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

        if($image = $request->file('image')) {
            $destinationPath = 'image/upload/';
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);

            $input['image'] = $destinationPath.$imageName;

            $path = public_path()."/".$partnership->image;
            File::delete($path);
        } else {
            unset($input['image']);
        }

        if($image = $request->file('logo')) {
            $destinationPath = 'image/upload/';
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);

            $input['logo'] = $destinationPath.$imageName;

            $path = public_path()."/".$partnership->logo;
            File::delete($path);
        } else {
            unset($input['logo']);
        }

        $partnership->update($input);

        return redirect('/admin/partnership')->withSuccess('Data Updated Successfully!');
    }

    public function destroy(Partnership $partnership)
    {
        $path = public_path()."/".$partnership->image;
        File::delete($path);

        $path = public_path()."/".$partnership->logo;
        File::delete($path);
        
        $partnership->delete();

        return redirect('/admin/partnership')->withSuccess('Data Deleted Successfully!');
    }
}
