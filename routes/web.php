<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyImageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeyFeatureController;
use App\Http\Controllers\MenuBarController;
use App\Http\Controllers\NewsArticleController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsTagController;
use App\Http\Controllers\PartnershipController;
use App\Http\Controllers\ProductBrandController;
use App\Http\Controllers\ProductHighlightController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TestimonialController;
use App\Models\NewsArticle;
use App\Models\NewsCategory;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

// Route::get('/', [HomeController::class, 'index']);
// Route::get('/our-company', [HomeController::class, 'ourCompany']);
// Route::get('/our-product', [HomeController::class, 'ourProduct']);
// Route::get('/catalogues', [HomeController::class, 'catalogues']);
// Route::get('/partnership', [HomeController::class, 'partnership']);
// Route::get('/news', [HomeController::class, 'news']);
// Route::get('/contact-us', [HomeController::class, 'contactUs']);

Route::get('/', function () {
    $languagedata = Session::get('languagedata');
    if(!$languagedata){
        $languagedata = 'en';
    }
    return redirect('/'.$languagedata.'\/');
});

Route::get('/our-company', function() {
    $languagedata = Session::get('languagedata');
    if(!$languagedata){
        $languagedata = 'en';
    }
    return redirect('/'.$languagedata.'/our-company'.'\/');
});

Route::get('/our-product', function() {
    $languagedata = Session::get('languagedata');
    if(!$languagedata){
        $languagedata = 'en';
    }
    return redirect('/'.$languagedata.'/our-product'.'\/');
});

Route::get('/catalogues', function() {
    $languagedata = Session::get('languagedata'.'\/');
    if(!$languagedata){
        $languagedata = 'en';
    }
    return redirect('/'.$languagedata.'/catalogues'.'\/');
});

Route::get('/partnership', function() {
    $languagedata = Session::get('languagedata');
    if(!$languagedata){
        $languagedata = 'en';
    }
    return redirect('/'.$languagedata.'/partnership'.'\/');
});

Route::get('/news', function() {
    $languagedata = Session::get('languagedata');
    if(!$languagedata){
        $languagedata = 'en';
    }
    return redirect('/'.$languagedata.'/news'.'\/');
});

Route::get('/contact-us', function() {
    $languagedata = Session::get('languagedata');
    if(!$languagedata){
        $languagedata = 'en';
    }
    return redirect('/'.$languagedata.'/contact-us');
});

Route::get('/news/{news_category:slug}', function(NewsCategory $news_category) {
    $languagedata = Session::get('languagedata');
    if(!$languagedata){
        $languagedata = 'en';
    }
    return redirect('/'.$languagedata.'/news'.'/'.$news_category->slug.'\/');
});

Route::get('/news/{news_category:slug}/{news_article:slug}', function(NewsCategory $news_category, NewsArticle $news_article) {
    $languagedata = Session::get('languagedata');
    if(!$languagedata){
        $languagedata = 'en';
    }
    return redirect('/'.$languagedata.'/news'.'/'.$news_category->slug.'/'.$news_article->slug.'\/');
});

Route::get('/our-product/{product_category:slug}', function(ProductCategory $product_category) {
    $languagedata = Session::get('languagedata');
    if(!$languagedata){
        $languagedata = 'en';
    }
    return redirect('/'.$languagedata.'/our-product'.'/'.$product_category->slug.'\/');
});

//User Authentication
Route::get('/admin/login', [AuthController::class, 'login'])->name('login');
Route::post('/admin/login', [AuthController::class, 'authenticate']);
Route::get('/admin/logout', [AuthController::class, 'logout']);


//Dashboard
Route::get('/admin', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('auth');
// Route::get('/admin/master-menu-bar', [MenuBarController::class])->middleware('auth');
// Route::get('/admin/master/menu-bar/{id}/edit', [MenuBarController::class, 'edit'])->middleware('auth');

//Resources
// Route::resource('/admin/languages', LanguageController::class)->middleware('auth');
// Route::resource('/admin/product-category', ProductCategoryController::class)->middleware('auth');

Route::resource('/admin/master/menubar', MenuBarController::class)->middleware('auth');
Route::resource('/admin/master/producthighlight', ProductHighlightController::class)->middleware('auth');
Route::resource('/admin/master/keyfeature', KeyFeatureController::class)->middleware('auth');
// Route::resource('/admin/master/company', CompanyController::class)->middleware('auth');
// Route::resource('/admin/master/company/image', CompanyImageController::class)->middleware('auth');

Route::prefix('admin')->group(static function() {
    Route::middleware('auth')->group(static function () {
        Route::resource('master/companyimage', CompanyImageController::class);
    });
});

Route::prefix('admin')->group(static function() {
    Route::middleware('auth')->group(static function () {
        Route::resource('master/company', CompanyController::class);
    });
});

Route::resource('/admin/partnership', PartnershipController::class)->middleware('auth');
Route::resource('/admin/testimonial', TestimonialController::class)->middleware('auth');

Route::resource('/admin/product/category', ProductCategoryController::class, ["as"=>"product"])->middleware('auth');
Route::resource('/admin/product/catalogue', CatalogueController::class)->middleware('auth');
Route::resource('/admin/product/brand', ProductBrandController::class)->middleware('auth');
Route::resource('/admin/product', ProductController::class)->middleware('auth');

Route::resource('/admin/news/category', NewsCategoryController::class, ["as"=>"news"])->middleware('auth');
Route::resource('/admin/news/tag', NewsTagController::class)->middleware('auth');
Route::resource('/admin/news/article', NewsArticleController::class)->middleware('auth');
Route::resource('/admin/news', NewsController::class)->middleware('auth');

Route::group(['prefix' => 'admin', 'as' =>'admin.'], function(){
    Route::post('images', [\App\Http\Controllers\ImageController::class, 'store'])->middleware('auth')->name('images.store');
});
Route::post('/admin/upload', 'ImageController@upload')->name('admin.upload');

Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
], function(){
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/our-company', [HomeController::class, 'ourCompany'])->name('our-company');
    Route::get('/our-product/{product_category:slug}', [ProductCategoryController::class, 'show']);
    Route::get('/catalogues', [HomeController::class, 'catalogues'])->name('catalogues');
    Route::get('/partnership', [HomeController::class, 'partnership'])->name('partnership');
    
    // ORI
    // Route::get('/news', [HomeController::class, 'news'])->name('news');
    // Route::get('/news/{slug}', [NewsArticleController::class, 'show']);
    // END OF ORI

    Route::bind('news_category', function($slug){
        return NewsCategory::whereSlug($slug)->first();
    });
    Route::bind('news_article', function($slug){
        return NewsArticle::whereSlug($slug)->first();
    });

    Route::get('/news', [NewsArticleController::class, 'home']);
    Route::get('/news/{news_category:slug}', [NewsCategoryController::class, 'show']);
    Route::get('/news/{news_category:slug}/{news_article:slug}', [NewsArticleController::class, 'show']);

    // Route::get('/news/{news_category:slug}/{news_article:slug}', function(NewsCategory $news_category, NewsArticle $news_article){
        
    // })->name('wjwjwjw');
    


    Route::get('/contact-us', [HomeController::class, 'contactUs']);
});

Route::post('/set_session', [SessionController::class, 'createsession']);

