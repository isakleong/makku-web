<?php

namespace App\Http\Controllers;

use App\Models\MenuBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuBarController extends Controller
{
    public function index()
    {
        $menuBar = MenuBar::all();

        // dd($menuBar);

        return view('administrator.menu-bar', compact('menuBar'));
    }

    public function create()
    {
        $parent = MenuBar::all();
        return view('administrator.menu-bar-create', compact('parent'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required',
            'title_id' => 'required',
            'orderNumber' => 'required',
            'refer' => 'required',
            'type' => 'required',
            'image' => 'image',
        ]);

        if(!$request->has('active')) {
            $request->merge(['active'=>'0']);
        } else {
            $request->merge(['active'=>'1']);
        }

        $input = $request->all();

        if($image = $request->file('image')) {
            $destinationPath = 'image/upload/';
            $imageName = strtolower($request->title_en) . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            // $input['image'] = $imageName;
            $input['image'] = $destinationPath.$imageName;
        } else {
            unset($input['image']);
        }

        MenuBar::create($input);

        return redirect('/admin/master/menubar')->withSuccess('Data Added Successfully!');
    }

    public function show(MenuBar $menuBar)
    {
        //
    }

    public function edit(MenuBar $menubar)
    {
        // dd($menubar->id);
        $parent = MenuBar::all();

        // dd($menubar);

        return view('administrator.menu-bar-edit', compact('menubar', 'parent'));
    }

    public function update(Request $request, MenuBar $menubar)
    {
        $request->validate([
            'title_en' => 'required',
            'title_id' => 'required',
            'orderNumber' => 'required',
            'refer' => 'required',
            'type' => 'required',
            'image' => 'image'
        ]);

        if(!$request->has('active')) {
            $request->merge(['active'=>'0']);
        } else {
            $request->merge(['active'=>'1']);
        }

        // dd($request->all());

        // if(strtolower($request->active) == 'on') {
        //     $request->merge(['active'=>'1']);
        // } else {
        //     $request->merge(['active'=>'0']);
        // }

        $input = $request->all();

        if($image = $request->file('image')) {
            $destinationPath = 'image/upload/';
            $imageName = strtolower($request->title_en) . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            // $input['image'] = $imageName;
            $input['image'] = $destinationPath.$imageName;
        } else {
            unset($input['image']);
        }

        $menubar->update($input);

        return redirect('/admin/master/menubar')->withSuccess('Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MenuBar  $menuBar
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuBar $menubar)
    {
        $menubar->delete();

        return redirect('/admin/master/menubar')->withSuccess('Data Deleted Successfully!');
    }
}
