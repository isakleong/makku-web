<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

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
                ->select(DB::raw('name, highlight_en as highlight, description_en as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp, phone'))
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
                ->select(DB::raw('name, highlight_id as highlight, description_id as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp, phone'))
                ->get()->first();

                $news = NewsArticle::with('category')->filterID(request(['search']))->latest()->paginate(6);
                // $news = NewsArticle::filterID(request(['search']))->latest()->get();
            }
        }
        return view('home.news', compact(['sectionTitle', 'menubar', 'company', 'news']));
    }

    public function create()
    {
        // $category = NewsCategory::all();
        $category = NewsCategory::where('active', 1)->get();

        return view('administrator.news-article-create', compact(['category']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoryID' => 'required',
            'title_en' => 'required',
            'title_id' => 'required',
            'content_en' => 'required',
            'content_id' => 'required',
            'image' => 'required',
        ]);

        try {
            
            $input = $request->all();

            //summernote image upload handling
            $content_en = $request->content_en;
            $domContent_en = new \DOMDocument();
            @$domContent_en->loadHtml($content_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFile = $domContent_en->getElementsByTagName('img');
            foreach($imageFile as $item => $image){
                $data = $image->getAttribute('src');
                
                if ($this->check_base64_image($data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $imageData = base64_decode($data);
                    $image_name= "/image/upload/"."en-".time().$item.'.png';
                    $path = public_path() . $image_name;
                    // file_put_contents($path, $imageData);
                    Image::make($imageData)->resize(1200, 630, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path);
                    
                    $image->removeAttribute('src');
                    $image->setAttribute('src', $image_name);
                } else {
                    // bad character
                }
            }
            $content_en = $domContent_en->saveHTML();
            $input['content_en'] = $content_en;

            $content_id = $request->content_id;
            $domContent_id = new \DOMDocument();
            @$domContent_id->loadHtml($content_id, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFile = $domContent_id->getElementsByTagName('img');
            foreach($imageFile as $item => $image){
                $data = $image->getAttribute('src');
                
                if ($this->check_base64_image($data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $imageData = base64_decode($data);
                    $image_name= "/image/upload/"."id-".time().$item.'.png';
                    $path = public_path() . $image_name;
                    // file_put_contents($path, $imageData);

                    Image::make($imageData)->resize(1200, 630, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path);
                    
                    $image->removeAttribute('src');
                    $image->setAttribute('src', $image_name);
                } else {
                    // bad character
                }
            }
            $content_id = $domContent_id->saveHTML();
            $input['content_id'] = $content_id;
            //end of summernote image upload handling

            if($image = $request->file('image')) {
                // $destinationPath = 'image/upload/';
                // $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // $imageName = $fileName."-".time(). "." .$image->getClientOriginalExtension();
                // $image->move($destinationPath, $imageName);
                // $input['image'] = $destinationPath.$imageName;

                $destinationPath = 'image/upload/';
                $generatedID = hexdec(uniqid());
                $imageName = $generatedID."-".time(). "." .$image->getClientOriginalExtension();
                Image::make($image)->resize(1200, 630, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.$imageName);

                $input['image'] = $destinationPath.$imageName;
            }

            //custom slug handler (indonesia or english)
            if($request->slug == 'id') {
                $slug = SlugService::createSlug(NewsArticle::class, 'slug', $input['title_id']);
                $input['slug'] = $slug;
            } else {
                $slug = SlugService::createSlug(NewsArticle::class, 'slug', $input['title_en']);
                $input['slug'] = $slug;
            }

            NewsArticle::create($input);

            return redirect('/admin/news/article')->withSuccess('Data Added Successfully!');
        } catch (\Exception $e) {
            $isForeignKey = Str::contains($e->getMessage(), 'SQLSTATE[23000]');
            if($isForeignKey) {
                return redirect('/admin/news/article')->with('errorData', 'News Article cannot be added because the data is not unique.');
            } else {
                return redirect('/admin/news/article')->with('errorData', $e->getMessage());
            }
        }
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
                ->select(DB::raw('name, highlight_en as highlight, description_en as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp, phone'))
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
                ->select(DB::raw('name, highlight_id as highlight, description_id as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp, phone'))
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

    private function check_base64_image($base64) {
        $base64 = preg_replace('#^data:image/[^;]+;base64,#', '', $base64);
        try {
            $img = imagecreatefromstring(base64_decode($base64));
            if (!$img) {
                return false;
            }

            imagepng($img, 'tmp.png');
            $info = getimagesize('tmp.png');

            unlink('tmp.png');

            if ($info[0] > 0 && $info[1] > 0 && $info['mime']) {
                return true;
            }

            return false;
        } catch(Exception $e) {
            return false;
        }
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

        try {
            $input = $request->all();

            //summernote image upload handling
            $content_en = $request->content_en;
            $domContent_en = new \DOMDocument();
            @$domContent_en->loadHtml($content_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFile = $domContent_en->getElementsByTagName('img');
            foreach($imageFile as $item => $image){
                $data = $image->getAttribute('src');
                
                if ($this->check_base64_image($data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $imageData = base64_decode($data);
                    $image_name= "/image/upload/"."en-".time().$item.'.png';
                    $path = public_path() . $image_name;
                    // file_put_contents($path, $imageData);

                    Image::make($imageData)->resize(1200, 630, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path);
                    
                    $image->removeAttribute('src');
                    $image->setAttribute('src', $image_name);
                } else {
                    // bad character
                }
            }
            $content_en = $domContent_en->saveHTML();
            $input['content_en'] = $content_en;

            $content_id = $request->content_id;
            $domContent_id = new \DOMDocument();
            @$domContent_id->loadHtml($content_id, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFile = $domContent_id->getElementsByTagName('img');
            foreach($imageFile as $item => $image){
                $data = $image->getAttribute('src');
                
                if ($this->check_base64_image($data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $imageData = base64_decode($data);
                    $image_name= "/image/upload/"."id-".time().$item.'.png';
                    $path = public_path() . $image_name;
                    // file_put_contents($path, $imageData);

                    Image::make($imageData)->resize(1200, 630, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path);
                    
                    $image->removeAttribute('src');
                    $image->setAttribute('src', $image_name);
                } else {
                    // bad character
                }
            }
            $content_id = $domContent_id->saveHTML();
            $input['content_id'] = $content_id;
            //end of summernote image upload handling
            
            //summernote image delete handling
            $existContent_en = $article->content_en;
            $domExistContent_en = new \DOMDocument();
            @$domExistContent_en->loadHtml($existContent_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $domExistContent_en->preserveWhiteSpace = false;
            $existImage  = $domExistContent_en->getElementsByTagName("img");
            $arrExistImage = array();
            for($i = 0; $i < $existImage->length; $i++) {
                $arrExistImage[] = $existImage[$i]->getAttribute("src");
            }

            $content_en = $request->content_en;
            $domContent_en = new \DOMDocument();
            @$domContent_en->loadHtml($content_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $domContent_en->preserveWhiteSpace = false;
            $imageFile  = $domContent_en->getElementsByTagName("img");
            $arrImage = array();
            for($i = 0; $i < $imageFile->length; $i++) {
                $arrImage[] = $imageFile[$i]->getAttribute("src");
            }
            $result=array_diff($arrExistImage, $arrImage);
            foreach($result as $deleteFile) {
                File::delete(public_path()."/".$deleteFile);
            }

            $existContent_id = $article->content_id;
            $domExistContent_id = new \DOMDocument();
            @$domExistContent_id->loadHtml($existContent_id, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $domExistContent_id->preserveWhiteSpace = false;
            $existImage  = $domExistContent_id->getElementsByTagName("img");
            $arrExistImage = array();
            for($i = 0; $i < $existImage->length; $i++) {
                $arrExistImage[] = $existImage[$i]->getAttribute("src");
            }

            $content_id = $request->content_id;
            $domContent_id = new \DOMDocument();
            @$domContent_id->loadHtml($content_id, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $domContent_id->preserveWhiteSpace = false;
            $imageFile  = $domContent_id->getElementsByTagName("img");
            $arrImage = array();
            for($i = 0; $i < $imageFile->length; $i++) {
                $arrImage[] = $imageFile[$i]->getAttribute("src");
            }
            $result=array_diff($arrExistImage, $arrImage);
            foreach($result as $deleteFile) {
                File::delete(public_path()."/".$deleteFile);
            }
            //end of summernote image delete handling

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

            // $article->slug = null;
            // $slug = SlugService::createSlug(NewsArticle::class, 'slug', $input['slug']);
            // $input['slug'] = $slug;
            $article->update($input);

            if($imageDelete != "") {
                File::delete($imageDelete);
            }

            return redirect('/admin/news/article')->withSuccess('Data Updated Successfully!');

        } catch (\Exception $e) {
            $isForeignKey = Str::contains($e->getMessage(), 'SQLSTATE[23000]');
            if($isForeignKey) {
                return redirect('/admin/news/article')->with('errorData', 'News Article cannot be updated because the data is not unique.');
            } else {
                return redirect('/admin/news/article')->with('errorData', $e->getMessage());
            }
        }
    }

    public function destroy(NewsArticle $article)
    {
        //summernote image delete handling
        $existContent_en = $article->content_en;
        $domExistContent_en = new \DOMDocument();
        @$domExistContent_en->loadHtml($existContent_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $domExistContent_en->preserveWhiteSpace = false;
        $existImage  = $domExistContent_en->getElementsByTagName("img");
        $arrExistImage = array();
        for($i = 0; $i < $existImage->length; $i++) {
            $arrExistImage[] = $existImage[$i]->getAttribute("src");
        }
        foreach($arrExistImage as $deleteFile) {
            File::delete(public_path()."/".$deleteFile);
        }

        $existContent_id = $article->content_id;
        $domExistContent_id = new \DOMDocument();
        @$domExistContent_id->loadHtml($existContent_id, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $domExistContent_id->preserveWhiteSpace = false;
        $existImage  = $domExistContent_id->getElementsByTagName("img");
        $arrExistImage = array();
        for($i = 0; $i < $existImage->length; $i++) {
            $arrExistImage[] = $existImage[$i]->getAttribute("src");
        }
        foreach($arrExistImage as $deleteFile) {
            File::delete(public_path()."/".$deleteFile);
        }
        //end of summernote image delete handling

        $imageDelete = public_path()."/".$article->image;
        
        $article->delete();

        File::delete($imageDelete);

        return redirect('/admin/news/article')->withSuccess('Data Deleted Successfully!');
    }
}
