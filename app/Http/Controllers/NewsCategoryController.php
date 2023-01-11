<?php

namespace App\Http\Controllers;

use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
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

        //custom slug handler (indonesia or english)
        if($request->slug == 'id') {
            $slug = SlugService::createSlug(NewsCategory::class, 'slug', $input['name_id']);
            $input['slug'] = $slug;
        } else {
            $slug = SlugService::createSlug(NewsCategory::class, 'slug', $input['name_en']);
            $input['slug'] = $slug;
        }

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
                ->select(DB::raw('name, highlight_en as highlight, description_en as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp, phone'))
                ->get()->first();

                //LAZY EAGER LOADING (without search function)
                // $news_category = $news_category->load('news');

                $news_category->load(['news' => function ($query) {
                    // $query->where('title_en', 'like', '%'.$filters['search'].'%')->orWhere('content_en', 'like', '%'.$filters['search'].'%');
                    
                    $filters = request(['search']);
                    $query->when($filters['search'] ?? false, function($query, $search){
                        return $query->where(function($query) use ($search) {
                            $query->where('title_en', 'like', '%' . $search . '%')->orWhere('content_en', 'like', '%' . $search . '%');
                        });
                    });
                }]);

            } elseif($locale == "id") {
                $sectionTitle = 'Kategori Berita';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_id as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_id as highlight, description_id as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp, phone'))
                ->get()->first();

                // $news_category = $news_category->load('news');

                $news_category->load(['news' => function ($query) {
                    // $query->where('title_en', 'like', '%'.$filters['search'].'%')->orWhere('content_en', 'like', '%'.$filters['search'].'%');
                    
                    $filters = request(['search']);
                    $query->when($filters['search'] ?? false, function($query, $search){
                        return $query->where(function($query) use ($search) {
                            $query->where('title_id', 'like', '%' . $search . '%')->orWhere('content_id', 'like', '%' . $search . '%');
                        });
                    });
                }]);
            }

            return view('home.news-category', compact(['sectionTitle', 'menubar', 'company', 'news_category']));
            // return ('hahah');
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
        $slug = SlugService::createSlug(NewsCategory::class, 'slug', $input['slug']);
        $input['slug'] = $slug;
        $category->update($input);

        return redirect('/admin/news/category')->withSuccess('Data Updated Successfully!');
    }

    public function destroy(NewsCategory $category)
    {
        $category->delete();

        return redirect('/admin/news/category')->withSuccess('Data Deleted Successfully!');
    }
}
