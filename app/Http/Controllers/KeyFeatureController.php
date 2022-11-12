<?php

namespace App\Http\Controllers;

use App\Models\KeyFeature;
use Illuminate\Http\Request;

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

        KeyFeature::create($input);

        return redirect('/admin/master/keyfeature')->withSuccess('Data Added Successfully!');
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

        $keyfeature->update($input);

        return redirect('/admin/master/keyfeature')->withSuccess('Data Updated Successfully!');
    }

    public function destroy(KeyFeature $keyfeature)
    {
        $keyfeature->delete();

        return redirect('/admin/master/keyfeature')->withSuccess('Data Deleted Successfully!');
    }
}
