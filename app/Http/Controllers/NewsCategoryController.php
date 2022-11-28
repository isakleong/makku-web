<?php

namespace App\Http\Controllers;

use App\Models\NewsCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{
    public function index()
    {
        $category = NewsCategory::all();

        return view('administrator.news-category', compact('category'));
    }

    public function create()
    {
        return view('administrator.news-category-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required',
            'name_id' => 'required'
        ]);

        if(!$request->has('active')) {
            $request->merge(['active'=>'0']);
        } else {
            $request->merge(['active'=>'1']);
        }

        $input = $request->all();

        NewsCategory::create($input);

        return redirect('/admin/news/category')->withSuccess('Data Added Successfully!');
    }

    public function show(NewsCategory $newsCategory)
    {
        //
    }

    public function edit(NewsCategory $category)
    {
        return view('administrator.news-category-edit', compact('category'));
    }

    public function update(Request $request, NewsCategory $category)
    {
        $request->validate([
            'name_en' => 'required',
            'name_id' => 'required'
        ]);

        if(!$request->has('active')) {
            $request->merge(['active'=>'0']);
        } else {
            $request->merge(['active'=>'1']);
        }

        $input = $request->all();

        $category->slug = null;
        $category->update($input);

        return redirect('/admin/news/category')->withSuccess('Data Updated Successfully!');
    }

    public function destroy(NewsCategory $category)
    {
        $category->delete();

        return redirect('/admin/news/category')->withSuccess('Data Deleted Successfully!');
    }
}
