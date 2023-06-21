<?php

namespace App\Http\Controllers;

use App\Models\CompanyImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

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

            CompanyImage::create($input);

            if (isset($input['image'])) {
                Image::make($image)->resize(1200, 630, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.$imageName);
            }

            return redirect('/admin/master/company')->withSuccess('Company Image added successfully!');
        } catch (\Exception $e) {
            $isForeignKey = Str::contains($e->getMessage(), 'SQLSTATE[23000]');
            if($isForeignKey) {
                return redirect('/admin/master/company')->with('errorData', 'Company Image cannot be added because the data is not unique. Please make sure there are no duplicate order number data.');
            } else {
                return redirect('/admin/master/company')->with('errorData', $e->getMessage());
            }
        }
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

        try {
            $input = $request->all();

            $imageDelete = "";
            if($image = $request->file('image')) {
                $imageDelete = public_path()."/".$companyimage->image;

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

            $companyimage->update($input);

            if (isset($input['image'])) {
                Image::make($image)->resize(1200, 630, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.$imageName);
            }

            if($imageDelete != "") {
                File::delete($imageDelete);
            }

            return redirect('/admin/master/company')->withSuccess('Company Image updated successfully!');

        } catch (\Exception $e) {
            $isForeignKey = Str::contains($e->getMessage(), 'SQLSTATE[23000]');
            if($isForeignKey) {
                return redirect('/admin/master/company')->with('errorData', 'Company Image cannot be updated because the data is not unique. Please make sure there are no duplicate order number data.');
            } else {
                return redirect('/admin/master/company')->with('errorData', $e->getMessage());
            }
        }
    }

    public function destroy(CompanyImage $companyimage)
    {
        $imageDelete = public_path()."/".$companyimage->image;

        $companyimage->delete();

        File::delete($imageDelete);

        return redirect('/admin/master/company')->withSuccess('Company Image deleted successfully!');
    }
}
