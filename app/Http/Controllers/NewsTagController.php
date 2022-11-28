<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NewsTag;
use Illuminate\Http\Request;

class NewsTagController extends Controller
{
    public function index()
    {
        $tag = NewsTag::all();

        return view('administrator.news-tag', compact('tag'));
    }

    public function create()
    {
        return view('administrator.news-tag-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required',
            'name_id' => 'required',
            'slug' => 'required'
        ]);

        if(!$request->has('active')) {
            $request->merge(['active'=>'0']);
        } else {
            $request->merge(['active'=>'1']);
        }

        $input = $request->all();

        NewsTag::create($input);

        return redirect('/admin/news/tag')->withSuccess('Data Added Successfully!');
    }

    public function show(Newstag $newstag)
    {
        //
    }

    public function edit(Newstag $tag)
    {
        return view('administrator.news-tag-edit', compact('tag'));
    }

    public function update(Request $request, Newstag $tag)
    {
        $request->validate([
            'name_en' => 'required',
            'name_id' => 'required',
            'slug' => 'required'
        ]);

        if(!$request->has('active')) {
            $request->merge(['active'=>'0']);
        } else {
            $request->merge(['active'=>'1']);
        }

        $input = $request->all();

        $tag->update($input);

        return redirect('/admin/news/tag')->withSuccess('Data Updated Successfully!');
    }

    public function destroy(Newstag $tag)
    {
        $tag->delete();

        return redirect('/admin/news/tag')->withSuccess('Data Deleted Successfully!');
    }
}
