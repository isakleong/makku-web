<?php

namespace App\Http\Controllers;

use App\Models\MenuBar;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;

class MenuBarController extends Controller
{
    public function index()
    {
        // $menuBar = MenuBar::all();

        $menuBar = DB::table('menu_bar as tbl_1')
            ->leftjoin('menu_bar as tbl_2', 'tbl_1.parent', '=', 'tbl_2.id')
            ->select(DB::raw('tbl_1.id, tbl_1.title_en, tbl_1.title_id, tbl_1.orderNumber, tbl_1.refer, tbl_1.type, concat(tbl_2.title_en, " (", tbl_2.title_id, ")") as parent, tbl_1.image, tbl_1.active'))
            ->get();

        // $menuBar = MenuBar::join('menu_bar as tbl_2', 'menu_bar.parent', '=', 'menu_bar.id')
        //     ->select(
        //         "menu_bar.id",
        //         "menu_bar.title_en",
        //         "menu_bar.title_id",
        //         "menu_bar.orderNumber",
        //         "menu_bar.refer",
        //         "menu_bar.type",
        //         "tbl_2.title_en as parent",
        //         "menu_bar.image",
        //         "menu_bar.active",
        //     )
        //     ->get();

        // select tbl_1.title_en, tbl_1.title_id, tbl_1.orderNumber, tbl_1.refer, tbl_1.type, tbl_2.title_en as parent, tbl_1.image, tbl_1.active
        // from menu_bar as tbl_1
        // left join menu_bar as tbl_2
        // on tbl_1.parent = tbl_2.id;

        // dd($menuBar);

        return view('administrator.menu-bar', compact('menuBar'));
    }

    public function create()
    {
        $parent = MenuBar::all();
        $productCategory = ProductCategory::where('active', 1)->get();
        return view('administrator.menu-bar-create', compact('parent', 'productCategory'));
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

        $menubar = MenuBar::where([
            // 'active' => 1,
            'type' => $request->type,
            'parent' => $request->parent,
            'orderNumber' => $request->orderNumber
        ])->get();

        $cntData = $menubar->count();
        if($cntData == 0) {
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
                // $image->move($destinationPath, $imageName);
                Image::make($image)->resize(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.$imageName);
    
                $input['image'] = $destinationPath.$imageName;
            } else {
                unset($input['image']);
            }
    
            MenuBar::create($input);
    
            return redirect('/admin/master/menubar')->withSuccess('Menu Bar added successfully!');
        } else {
            $dataExist = "";
            $i = 0;
            foreach($menubar as $item) {
                if($i == $cntData-1) {
                    $dataExist.=$item->title_en;
                } else {
                    $dataExist.=$item->title_en.", ";
                }
                $i++;
            }
            // Alert::toast('You\'ve Successfully Registered', 'success');
            return redirect('/admin/master/menubar')->with('error', $dataExist);
        }
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

        if($request->has('discard')) {
            $request->merge(['image'=>null]);
            $path = public_path()."/".$menubar->image;
            File::delete($path);
        }

        $input = $request->all();

        $imageDelete = "";
        if($image = $request->file('image')) {
            $imageDelete = public_path()."/".$menubar->image;

            //commented because never trust client side inputs
            // $destinationPath = 'image/upload/';
            // $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            // $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            // $image->move($destinationPath, $imageName);

            $destinationPath = 'image/upload/';
            $generatedID = hexdec(uniqid());
            $imageName = $generatedID."-".time(). "." .$image->getClientOriginalExtension();
            // $image->move($destinationPath, $imageName);
            Image::make($image)->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.$imageName);

            $input['image'] = $destinationPath.$imageName;
        } else {
            unset($input['image']);
        }

        $menubar->update($input);

        if($imageDelete != "") {
            File::delete($imageDelete);
        }

        return redirect('/admin/master/menubar')->withSuccess('Menu Bar updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MenuBar  $menuBar
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuBar $menubar)
    {
        $imageDelete = public_path()."/".$menubar->image;

        $menubar->delete();

        File::delete($imageDelete);

        return redirect('/admin/master/menubar')->withSuccess('Menu Bar deleted successfully!');
    }
}
