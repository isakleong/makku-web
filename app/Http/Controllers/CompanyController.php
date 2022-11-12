<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::all();

        return view('administrator.company', compact('company'));
    }

    public function create()
    {
        return view('administrator.company-create');
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
            $imageName = strtolower($request->name_id) . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            // $input['image'] = $imageName;
            $input['image'] = $destinationPath.$imageName;
        }

        if($image = $request->file('logoPrimary')) {
            $destinationPath = 'image/upload/';
            $imageName = strtolower($request->name_id) . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            // $input['image'] = $imageName;
            $input['logoPrimary'] = $destinationPath.$imageName;
        }

        if($image = $request->file('logoSecondary')) {
            $destinationPath = 'image/upload/';
            $imageName = strtolower($request->name_id) . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            // $input['image'] = $imageName;
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
            $imageName = strtolower($request->name_id) . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            // $input['image'] = $imageName;
            $input['image'] = $destinationPath.$imageName;
        } else {
            unset($input['image']);
        }

        if($image = $request->file('logoPrimary')) {
            $destinationPath = 'image/upload/';
            $imageName = strtolower($request->name_id) . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            // $input['image'] = $imageName;
            $input['logoPrimary'] = $destinationPath.$imageName;
        } else {
            unset($input['logoPrimary']);
        }

        if($image = $request->file('logoSecondary')) {
            $destinationPath = 'image/upload/';
            $imageName = strtolower($request->name_id) . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            // $input['image'] = $imageName;
            $input['logoSecondary'] = $destinationPath.$imageName;
        } else {
            unset($input['logoSecondary']);
        }

        $company->update($input);

        return redirect('/admin/master/company')->withSuccess('Data Updated Successfully!');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect('/admin/master/company')->withSuccess('Data Deleted Successfully!');
    }
}
