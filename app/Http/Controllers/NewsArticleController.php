<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsArticleController extends Controller
{
    public function index()
    {
        $article = NewsArticle::all();

        return view('administrator.news-article', compact('article'));
    }

    public function create()
    {
        return view('administrator.news-article-create');
    }

    public function store(Request $request)
    {

        // dd($request);
        $request->validate([
            'title_en' => 'required',
            'title_id' => 'required',
            'content_en' => 'required',
            'content_id' => 'required',
            'author' => 'required'
        ]);

        $input = $request->all();

        NewsArticle::create($input);

        return redirect('/admin/news/article')->withSuccess('Data Added Successfully!');
    }

    public function show(NewsArticle $newsArticle)
    {
        //
    }

    public function edit(NewsArticle $article)
    {
        return view('administrator.news-article-edit', compact('article'));
    }

    public function update(Request $request, NewsArticle $article)
    {
        $request->validate([
            'title_en' => 'required',
            'title_id' => 'required',
            'content_en' => 'required',
            'content_id' => 'required',
            'author' => 'required'
        ]);

        $input = $request->all();

        $article->update($input);

        return redirect('/admin/news/article')->withSuccess('Data Updated Successfully!');
    }

    public function destroy(NewsArticle $article)
    {
        $article->delete();

        return redirect('/admin/news/article')->withSuccess('Data Deleted Successfully!');
    }
}
