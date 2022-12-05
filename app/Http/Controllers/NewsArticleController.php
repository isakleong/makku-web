<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class NewsArticleController extends Controller
{
    public function uploadimage(Request $request){
        if($request->hasFile('upload')){
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '-' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('image/upload'), $fileName);

            $url = asset('/image/upload', $fileName);

            // $destinationPath = 'image/upload/';
            // $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            // $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            // $image->move($destinationPath, $imageName);
            // $input['image'] = $destinationPath.$imageName;  

            return response()->json([
                'fileName' => $fileName,
                'uploaded' => 1,
                'url' => $url
            ]);
        }
    }

    public function index()
    {
        $article = NewsArticle::all();

        return view('administrator.news-article', compact('article'));
    }

    public function home($locale = 'en')
    {
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

                $news = NewsArticle::with('category')->filterEN(request(['search']))->latest()->paginate(6);
                // $news = NewsArticle::filterEN(request(['search']))->latest()->get();

            } elseif($locale == "id") {
                $sectionTitle = 'Berita';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_id as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_id as highlight, description_id as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp'))
                ->get()->first();

                $news = NewsArticle::with('category')->filterID(request(['search']))->latest()->paginate(6);
                // $news = NewsArticle::filterID(request(['search']))->latest()->get();
            }
        }
        return view('home.news', compact(['sectionTitle', 'menubar', 'company', 'news']));
    }

    public function create()
    {
        $category = NewsCategory::all();

        return view('administrator.news-article-create', compact(['category']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoryID' => 'required',
            'title_en' => 'required',
            'title_id' => 'required',
            'slug' => 'required',
            'content_en' => 'required',
            'content_id' => 'required',
            'image' => 'required',
        ]);

        $input = $request->all();

        if($image = $request->file('image')) {
            $destinationPath = 'image/upload/';
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['image'] = $destinationPath.$imageName;
        }

        NewsArticle::create($input);

        return redirect('/admin/news/article')->withSuccess('Data Added Successfully!');
    }

    public function show($locale, NewsCategory $news_category, NewsArticle $news_article)
    {   
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

                // $article = DB::table('news_article')
                // ->join('news_category', 'news_category.id', '=', 'news_article.categoryID')
                // ->select(DB::raw('news_article.*, news_category.name_en as category, news_article.image as image, news_article.title_en as title, news_article.slug_en as slug, news_article.content_en as content, news_article.tags_en as tags, news_article.author, news_article.created_at as publishDate'))
                // ->where('news_article.slug_en', $slug)
                // ->get();

                $news_article = $news_article->load('category');

                

                // $news_category = $news_category->load('news');

            } elseif($locale == "id") {
                $sectionTitle = 'Berita';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_id as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_id as highlight, description_id as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp'))
                ->get()->first();

                // $article = DB::table('news_article')
                // ->join('news_category', 'news_category.id', '=', 'news_article.categoryID')
                // ->select(DB::raw('news_article.*, news_category.name_id as category, news_article.image as image, news_article.title_id as title, news_article.slug_id as slug, news_article.content_id as content, news_article.tags_id as tags, news_article.author, news_article.created_at as publishDate'))
                // ->where('news_article.slug_id', $slug)
                // ->get();

                $news_article = $news_article->load('category');
                // $news_category = $news_category->load('news');
            }

            // dd($article);
            return view('home.news-detail', compact(['sectionTitle', 'menubar', 'company', 'news_category', 'news_article']));
        }  
    }

    public function edit(NewsArticle $article)
    {
        $category = NewsCategory::all();
        $categorySelected = DB::table('news_category')->where('id', $article->categoryID)->first();
        return view('administrator.news-article-edit', compact('article', 'category', 'categorySelected'));
    }

    public function update(Request $request, NewsArticle $article)
    {
        $request->validate([
            'categoryID' => 'required',
            'title_en' => 'required',
            'title_id' => 'required',
            'slug' => 'required',
            'content_en' => 'required',
            'content_id' => 'required',
            'image' => 'image'
        ]);

        $input = $request->all();

        $imageDelete = "";
        if($image = $request->file('image')) {
            $imageDelete = public_path()."/".$article->image;

            $destinationPath = 'image/upload/';
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['image'] = $destinationPath.$imageName;
        } else {
            unset($input['image']);
        }

        $article->update($input);

        if($imageDelete != "") {
            File::delete($imageDelete);
        }

        return redirect('/admin/news/article')->withSuccess('Data Updated Successfully!');
    }

    public function destroy(NewsArticle $article)
    {
        $article->delete();

        return redirect('/admin/news/article')->withSuccess('Data Deleted Successfully!');
    }
}
