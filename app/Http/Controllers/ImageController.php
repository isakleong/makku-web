<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NewsArticle;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request){
        $article = NewsArticle::find(1);
        $article->id = 0;
        $article->exists = true;
        // $image = $article->addMediaFromRequest('upload')->toMediaCollection('images');
        $image = $article->addMediaFromRequest('upload')->toMediaCollection('images');

        return response()->json([
            // 'url' => 'https://laraveldaily.com/wp-content/uploads/2018/12/laravel-daily-2.png'
            'url' => $image->getFullUrl()
        ]);
    }

    // public function upload(Request $request)
    // {
    //     if($request->hasFile('upload')) {
    //         $originName = $request->file('upload')->getClientOriginalName();
    //         $fileName = pathinfo($originName, PATHINFO_FILENAME);
    //         $extension = $request->file('upload')->getClientOriginalExtension();
    //         $fileName = $fileName.'_'.time().'.'.$extension;
        
    //         $request->file('upload')->move(public_path('images'), $fileName);
   
    //         $CKEditorFuncNum = $request->input('CKEditorFuncNum');
    //         $url = asset('images/'.$fileName); 
    //         $msg = 'Image uploaded successfully'; 
    //         $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
    //         @header('Content-type: text/html; charset=utf-8'); 
    //         echo $response;
    //     }
    // }

}
