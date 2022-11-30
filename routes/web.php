<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyImageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\KeyFeatureController;
use App\Http\Controllers\LanguageController;
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
use App\Http\Controllers\TestimonialController;
use App\Models\NewsArticle;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
Route::get('/our-company', [HomeController::class, 'ourCompany']);
Route::get('/our-product', [HomeController::class, 'ourProduct']);
Route::get('/catalogues', [HomeController::class, 'catalogues']);
Route::get('/partnership', [HomeController::class, 'partnership']);
Route::get('/news', [HomeController::class, 'news']);
Route::get('/contact-us', [HomeController::class, 'contactUs']);

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
    Route::get('/our-product', [HomeController::class, 'ourProduct'])->name('our-product');
    Route::get('/catalogues', [HomeController::class, 'catalogues'])->name('catalogues');
    Route::get('/partnership', [HomeController::class, 'partnership'])->name('partnership');
    Route::get('/news', [HomeController::class, 'news'])->name('news');
    // Route::get('/news/{category}/{slug}', function($category, $slug) {
    //     return view('home.news-detail');
    // });
    // Route::get('/news/{category}/{slug}', [HomeController::class, 'newsDetail']);

    Route::get('/news/{slug}', [NewsArticleController::class, 'show']);
    
    // Route::get('/news/{article:slug_en}', [NewsArticleController::class, 'show']);
    // Route::get('/news/{article:slug_id}', [NewsArticleController::class, 'show']);

    Route::get('/contact-us', [HomeController::class, 'contactUs']);
});

// Route::post('/upload', [NewsArticleController::class, 'uploadimage'])->name('ckeditor.upload');