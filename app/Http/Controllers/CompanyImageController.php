<?php

namespace App\Http\Controllers;

use App\Models\CompanyImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CompanyImageController extends Controller
{
    public function index()
    {
        // $companyImage = CompanyImage::all();

        // return view('administrator.company-image-create', compact('companyImage'));
    }

    public function create()
    {
        return view('administrator.company-image-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'orderNumber' => 'required'
        ]);

        $input = $request->all();

        if($image = $request->file('image')) {
            $destinationPath = 'image/upload/';
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['image'] = $destinationPath.$imageName;
        }

        CompanyImage::create($input);

        return redirect('/admin/master/company')->withSuccess('Data Added Successfully!');
    }

    public function show(CompanyImage $companyImage)
    {
        //
    }

    public function edit(CompanyImage $companyimage)
    {
        return view('administrator.company-image-edit', compact('companyimage'));
    }

    public function update(Request $request, CompanyImage $companyimage)
    {
        // dd($request->all());

        $request->validate([
            'image' => 'image',
            'orderNumber' => 'required'
        ]);

        $input = $request->all();

        $imageDelete = "";
        if($image = $request->file('image')) {
            $imageDelete = public_path()."/".$companyimage->image;

            $destinationPath = 'image/upload/';
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['image'] = $destinationPath.$imageName;
        } else {
            unset($input['image']);
        }

        $companyimage->update($input);

        if($imageDelete != "") {
            File::delete($imageDelete);
        }

        return redirect('/admin/master/company')->withSuccess('Data Updated Successfully!');
    }

    public function destroy(CompanyImage $companyimage)
    {
        $imageDelete = public_path()."/".$companyimage->image;

        $companyimage->delete();

        File::delete($imageDelete);

        return redirect('/admin/master/company')->withSuccess('Data Deleted Successfully!');
    }
}
