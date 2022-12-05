<?php

namespace App\Http\Controllers;

use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

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

    public function show($locale, NewsCategory $news_category)
    {
        $availableLanguage = ['en', 'id'];

        if(in_array($locale, $availableLanguage)) {
            Session::put('languagedata', $locale);
            
            if($locale == "en") {
                $sectionTitle = 'News Category';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_en as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_en as highlight, description_en as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp'))
                ->get()->first();

                $news_category = $news_category->load('news');

            } elseif($locale == "id") {
                $sectionTitle = 'Kategori Berita';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_id as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_id as highlight, description_id as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp'))
                ->get()->first();

                $news_category = $news_category->load('news');
            }

            return view('home.news-category', compact(['sectionTitle', 'menubar', 'company', 'news_category']));
        }
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
