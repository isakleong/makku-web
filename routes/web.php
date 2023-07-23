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

//Handling if loaded without locale prefix
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
    $languagedata = Session::get('languagedata');
    if(!$languagedata){
        $languagedata = 'id';
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
    return redirect('/'.$languagedata.'/contact-us'.'\/');
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
//End of Handling if loaded without locale prefix

//User Authentication
Route::get('/admin/login', [AuthController::class, 'login'])->name('login');
Route::post('/admin/login', [AuthController::class, 'authenticate']);
Route::get('/admin/logout', [AuthController::class, 'logout']);
//End of User Authentication


//Admin panel
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function() {
    // Route::get('/', [DashboardController::class, 'index']);
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //spatie laravel image (successfully tested on CKEditor) --> not used anymore, because already using Summernote with image upload handler
    Route::post('images', [\App\Http\Controllers\ImageController::class, 'store'])->middleware('auth')->name('images.store');

    //google analytic handler
    Route::post('dashboard/sum-views', [\App\Http\Controllers\DashboardController::class, 'ga4_totalViews'])->middleware('auth')->name('dashboard.filterSumViews');
    Route::post('dashboard/sum-visitors', [\App\Http\Controllers\DashboardController::class, 'ga4_totalUsers'])->middleware('auth')->name('dashboard.filterSumVisitors');
    Route::post('dashboard/sum-returning-visitors', [\App\Http\Controllers\DashboardController::class, 'ga4_totalNewAndReturningUsers'])->middleware('auth')->name('dashboard.filterSumReturningVisitors');
    Route::post('dashboard/sum-avg-sessions', [\App\Http\Controllers\DashboardController::class, 'ga4_averageSessionDuration'])->middleware('auth')->name('dashboard.filterSumAvgSessions');
    Route::post('dashboard/most-views', [\App\Http\Controllers\DashboardController::class, 'ga4_mostViewsByPage'])->middleware('auth')->name('dashboard.filterMostViewsByPage');
    Route::post('dashboard/total-users', [\App\Http\Controllers\DashboardController::class, 'ga4_totalUsersByDate'])->middleware('auth')->name('dashboard.filterTotalUsersByDate');
    //end of google analytic handler

    Route::resource('master/menubar', MenuBarController::class, ["as"=>"master"]);
    Route::resource('master/producthighlight', ProductHighlightController::class, ["as"=>"master"]);
    Route::resource('master/keyfeature', KeyFeatureController::class, ["as"=>"master"]);

    Route::resource('master/companyimage', CompanyImageController::class, ["as"=>"master"]);
    Route::resource('master/company', CompanyController::class, ["as"=>"master"]);

    Route::resource('partnership', PartnershipController::class);
    Route::resource('testimonial', TestimonialController::class);

    Route::resource('product/catalogue', CatalogueController::class, ["as"=>"product"]);
    Route::resource('product/category', ProductCategoryController::class, ["as"=>"product"]);
    Route::resource('product/brand', ProductBrandController::class, ["as"=>"product"]);
    Route::resource('product/item', ProductController::class, ["as"=>"product"]);

    Route::resource('news/category', NewsCategoryController::class, ["as"=>"news"]);
    Route::resource('news/tag', NewsTagController::class);
    Route::resource('news/article', NewsArticleController::class, ["as"=>"news"]);
    Route::resource('news', NewsController::class);

    Route::post('upload', 'ImageController@upload');
});
//End of Admin Panel

// Route::get('/admin', [DashboardController::class, 'index'])->middleware('auth');
// Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('auth');
// Route::resource('/admin/master/menubar', MenuBarController::class)->middleware('auth');
// Route::resource('/admin/master/producthighlight', ProductHighlightController::class)->middleware('auth');
// Route::resource('/admin/master/keyfeature', KeyFeatureController::class)->middleware('auth');
// Route::prefix('admin')->group(static function() {
//     Route::middleware('auth')->group(static function () {
//         Route::resource('master/companyimage', CompanyImageController::class);
//     });
// });
// Route::prefix('admin')->group(static function() {
//     Route::middleware('auth')->group(static function () {
//         Route::resource('master/company', CompanyController::class);
//     });
// });
// Route::resource('/admin/partnership', PartnershipController::class)->middleware('auth');
// Route::resource('/admin/testimonial', TestimonialController::class)->middleware('auth');
// Route::resource('/admin/product/category', ProductCategoryController::class, ["as"=>"product"])->middleware('auth');
// Route::resource('/admin/product/catalogue', CatalogueController::class)->middleware('auth');
// Route::resource('/admin/product/brand', ProductBrandController::class)->middleware('auth');
// Route::resource('/admin/product', ProductController::class)->middleware('auth');
// Route::resource('/admin/news/category', NewsCategoryController::class, ["as"=>"news"])->middleware('auth');
// Route::resource('/admin/news/tag', NewsTagController::class)->middleware('auth');
// Route::resource('/admin/news/article', NewsArticleController::class)->middleware('auth');
// Route::resource('/admin/news', NewsController::class)->middleware('auth');

// Route::group(['prefix' => 'admin', 'as' =>'admin.'], function(){
//     //spatie laravel image (successfully tested on CKEditor) --> not used anymore, because already using Summernote with image upload handler
//     Route::post('images', [\App\Http\Controllers\ImageController::class, 'store'])->middleware('auth')->name('images.store');

//     //dashboard admin controller (google analytic handler)
//     Route::post('dashboard/sum-views', [\App\Http\Controllers\DashboardController::class, 'ga4_totalViews'])->middleware('auth')->name('dashboard.filterSumViews');
//     Route::post('dashboard/sum-visitors', [\App\Http\Controllers\DashboardController::class, 'ga4_totalUsers'])->middleware('auth')->name('dashboard.filterSumVisitors');
//     Route::post('dashboard/sum-returning-visitors', [\App\Http\Controllers\DashboardController::class, 'ga4_totalNewAndReturningUsers'])->middleware('auth')->name('dashboard.filterSumReturningVisitors');
//     Route::post('dashboard/sum-avg-sessions', [\App\Http\Controllers\DashboardController::class, 'ga4_averageSessionDuration'])->middleware('auth')->name('dashboard.filterSumAvgSessions');
    

//     Route::post('dashboard/most-views', [\App\Http\Controllers\DashboardController::class, 'ga4_mostViewsByPage'])->middleware('auth')->name('dashboard.filterMostViewsByPage');
//     Route::post('dashboard/total-users', [\App\Http\Controllers\DashboardController::class, 'ga4_totalUsersByDate'])->middleware('auth')->name('dashboard.filterTotalUsersByDate');
// });
// Route::post('/admin/upload', 'ImageController@upload')->name('admin.upload');
//End of Admin Panel

//Homepage
Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
], function(){
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/our-company', [HomeController::class, 'ourCompany'])->name('our-company');
    Route::get('/our-product/{product_category:slug}', [ProductCategoryController::class, 'show']);
    Route::get('/catalogues', [HomeController::class, 'catalogues'])->name('catalogues');
    Route::get('/partnership', [HomeController::class, 'partnership'])->name('partnership');
    Route::bind('news_category', function($slug){
        return NewsCategory::whereSlug($slug)->first();
    });
    Route::bind('news_article', function($slug){
        return NewsArticle::whereSlug($slug)->first();
    });
    Route::get('/news', [NewsArticleController::class, 'home']);
    Route::get('/news/{news_category:slug}', [NewsCategoryController::class, 'show']);
    
    //news detail
    Route::get('/news/{news_category:slug}/{news_article:slug}', [NewsArticleController::class, 'show']);

    Route::get('/contact-us', [HomeController::class, 'contactUs']);
});
//End of Homepage

//AJAX Controller
Route::post('/set_session', [SessionController::class, 'createsession']);
Route::post('/set_type', [SessionController::class, 'getSelectedType']);
Route::put('/set_type', [SessionController::class, 'getSelectedType']);
Route::post('/set_parent', [SessionController::class, 'setSelectedParent']);
Route::get('/get_parent', [SessionController::class, 'getSelectedParent']);
//End of AJAX Controller

