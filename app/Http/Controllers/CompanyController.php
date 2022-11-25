<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::all();
        $companyImage = CompanyImage::all();

        return view('administrator.company', compact('company', 'companyImage'));
    }

    public function create()
    {
        $company = Company::all();
        if(!count($company) > 0) {
            return view('administrator.company', compact('company'));
            // return redirect()->route('/admin/master/company');

            return redirect()->action([CompanyController::class, 'index']);
        } else {
            return view('administrator.company-create');
        }

        // return view('administrator.company-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'highlight_en' => 'required',
            'highlight_id' => 'required',
            'description_en' => 'required',
            'description_id' => 'required',
            'image' => 'required|image',
            'logoPrimary' => 'required|image',
            'logoSecondary' => 'required|image',
            'address' => 'required',
            'email' => 'required',
            'facebook' => 'required',
            'instagram' => 'required',
            'whatsapp' => 'required'
        ]);

        $input = $request->all();

        if($image = $request->file('image')) {
            $destinationPath = 'image/upload/';
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['image'] = $destinationPath.$imageName;
        }

        if($image = $request->file('logoPrimary')) {
            $destinationPath = 'image/upload/';
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['logoPrimary'] = $destinationPath.$imageName;
        }

        if($image = $request->file('logoSecondary')) {
            $destinationPath = 'image/upload/';
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['logoSecondary'] = $destinationPath.$imageName;
        }

        Company::create($input);

        return redirect('/admin/master/company')->withSuccess('Data Added Successfully!');
    }

    public function show(Company $company)
    {
        //
    }

    public function edit(Company $company)
    {
        return view('administrator.company-edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'highlight_en' => 'required',
            'highlight_id' => 'required',
            'description_en' => 'required',
            'description_id' => 'required',
            'image' => 'image',
            'logoPrimary' => 'image',
            'logoSecondary' => 'image',
            'address' => 'required',
            'email' => 'required',
            'facebook' => 'required',
            'instagram' => 'required',
            'whatsapp' => 'required'
        ]);

        $input = $request->all();

        $imageDelete = "";
        if($image = $request->file('image')) {
            $imageDelete = public_path()."/".$company->image;

            $destinationPath = 'image/upload/';
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['image'] = $destinationPath.$imageName;
        } else {
            unset($input['image']);
        }

        $logoPrimaryDelete = "";
        if($image = $request->file('logoPrimary')) {
            $logoPrimaryDelete = public_path()."/".$company->logoPrimary;

            $destinationPath = 'image/upload/';
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['logoPrimary'] = $destinationPath.$imageName;
        } else {
            unset($input['logoPrimary']);
        }

        $logoSecondaryDelete  = "";
        if($image = $request->file('logoSecondary')) {
            $logoSecondaryDelete = public_path()."/".$company->logoSecondary;

            $destinationPath = 'image/upload/';
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['logoSecondary'] = $destinationPath.$imageName;
        } else {
            unset($input['logoSecondary']);
        }

        $company->update($input);

        if($imageDelete != "") {
            File::delete($imageDelete);
        }
        if($logoPrimaryDelete != "") {
            File::delete($logoPrimaryDelete);
        }
        if($logoSecondaryDelete != "") {
            File::delete($logoSecondaryDelete);
        }

        return redirect('/admin/master/company')->withSuccess('Data Updated Successfully!');
    }

    public function destroy(Company $company)
    {
        $imageDelete = public_path()."/".$company->image;
        $logoPrimaryDelete = public_path()."/".$company->logoPrimary;
        $logoSecondaryDelete = public_path()."/".$company->logoSecondary;

        $company->delete();

        File::delete($imageDelete);
        File::delete($logoPrimaryDelete);
        File::delete($logoSecondaryDelete);

        return redirect('/admin/master/company')->withSuccess('Data Deleted Successfully!');
    }
}
