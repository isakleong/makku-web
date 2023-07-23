<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Http\Controllers\Controller;
use App\Models\NewsArticle;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::join('news_category', 'news_category.id', '=', 'news.categoryID')
            ->join('news_article', 'news_article.id', '=', 'news.articleID')
            ->select(
                "news.id",
                "news.active",
                "news_category.name_en as categoryName",
                "news_article.title_en as articleTitle"
            )
            ->get();

        return view('administrator.news-item', compact('news'));
    }

    public function create()
    {
        $category = NewsCategory::all();
        $article = NewsArticle::all();
        return view('administrator.news-item-create', compact(['category', 'article']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoryID' => 'required',
            'articleID' => 'required'
        ]);

        if(!$request->has('active')) {
            $request->merge(['active'=>'0']);
        } else {
            $request->merge(['active'=>'1']);
        }

        $input = $request->all();

        News::create($input);

        return redirect('/admin/news')->withSuccess('Data Added Successfully!');
    }

    public function show($locale, $xx, $id)
    {
        // dd($locale. " - ". $xx. " - ".$id);
        $availableLanguage = ['en', 'id'];

        if(in_array($locale, $availableLanguage)) {
            Session::put('languagedata', $locale);

            if($locale == "en") {
                $sectionTitle = 'News';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_en as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_en as highlight, description_en as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp'))
                ->get()->first();

                $news = NewsArticle::find($id);

            } elseif($locale == "id") {
                $sectionTitle = 'News';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_id as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_id as highlight, description_id as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp'))
                ->get()->first();

                $news = NewsArticle::find($id);
            }
            return view('home.news-detail', compact(['sectionTitle', 'menubar', 'company', 'news']));
        }   
    }

    public function edit(News $news)
    {
        $category = NewsCategory::all();
        $article = NewsArticle::all();

        $categorySelected = DB::table('news_category')->where('id', $news->categoryID)->first();
        $articleSelected = DB::table('news_article')->where('id', $news->articleID)->first();

        return view('administrator.news-item-edit', compact(['news', 'category', 'article', 'categorySelected', 'articleSelected']));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'categoryID' => 'required',
            'articleID' => 'required'
        ]);

        if(!$request->has('active')) {
            $request->merge(['active'=>'0']);
        } else {
            $request->merge(['active'=>'1']);
        }

        $input = $request->all();

        $news->update($input);

        return redirect('/admin/news')->withSuccess('Data Updated Successfully!');
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect('/admin/news')->withSuccess('Data Deleted Successfully!');
    }
}
