<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CatalogueController extends Controller
{
    public function index()
    {
        $catalogue = Catalogue::all();

        return view('administrator.catalogue', compact('catalogue'));
    }

    public function create()
    {
        return view('administrator.catalogue-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required',
            'name_en' => 'nullable',
            'name_id' => 'nullable',
        ]);

        if(!$request->has('active')) {
            $request->merge(['active'=>'0']);
        } else {
            $request->merge(['active'=>'1']);
        }

        $input = $request->all();

        if($image = $request->file('file')) {
            $destinationPath = 'file/upload/';
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            
            $input['file'] = $destinationPath.$imageName;
        } else {
            unset($input['file']);
        }

        Catalogue::create($input);

        return redirect('/admin/product/catalogue')->withSuccess('Data Added Successfully!');
    }

    public function show(Catalogue $catalogue)
    {
        //
    }

    public function edit(Catalogue $catalogue)
    {
        return view('administrator.catalogue-edit', compact('catalogue'));
    }

    public function update(Request $request, Catalogue $catalogue)
    {
        $request->validate([
            'file' => 'nullable',
            'name_en' => 'nullable',
            'name_id' => 'nullable',
        ]);

        if(!$request->has('active')) {
            $request->merge(['active'=>'0']);
        } else {
            $request->merge(['active'=>'1']);
        }

        $input = $request->all();

        $imageDelete = "";
        if($image = $request->file('file')) {
            $imageDelete = public_path()."/".$catalogue->file;

            $destinationPath = 'file/upload/';
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['file'] = $destinationPath.$imageName;
        } else {
            unset($input['file']);
        }

        $catalogue->update($input);

        if($imageDelete != "") {
            File::delete($imageDelete);
        }

        return redirect('/admin/product/catalogue')->withSuccess('Data Updated Successfully!');
    }

    public function destroy(Catalogue $catalogue)
    {
        $imageDelete = public_path()."/".$catalogue->file;

        $catalogue->delete();

        if($imageDelete != "") {
            File::delete($imageDelete);
        }

        return redirect('/admin/product/catalogue')->withSuccess('Data Deleted Successfully!');
    }
}
