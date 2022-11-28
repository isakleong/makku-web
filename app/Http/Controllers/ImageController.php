<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NewsArticle;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request){
        $article = NewsArticle();
        $artilce->id = 0;
        $article->exists = true;
        // $image = $article->addMediaFromRequest('upload')->toMediaCollection('images');
        $image = $article->

        return response()->json([
            // 'url' => 'https://laraveldaily.com/wp-content/uploads/2018/12/laravel-daily-2.png'
            'url' => $image->getUrl()
        ])
    }
}
